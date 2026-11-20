<?php

namespace Tests\Feature;

use App\Mail\ContactMessageNotification;
use App\Models\ContactMessage;
use App\Models\SiteSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    private function validPayload(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Jane',
            'email' => 'jane@example.com',
            'subject' => 'Hello',
            'message' => 'I would like to work with you.',
            'website' => '',
            'form_token' => encrypt(now()->subMinute()->timestamp),
        ], $overrides);
    }

    public function test_message_is_stored_and_emailed_to_configured_receiver(): void
    {
        Mail::fake();
        config(['mail.contact_receiver' => 'owner@example.com']);

        $this->post('/contact', $this->validPayload())
            ->assertRedirect('/contact')
            ->assertSessionHas('success');

        $this->assertDatabaseHas('contact_messages', ['email' => 'jane@example.com']);
        Mail::assertSent(ContactMessageNotification::class, fn ($mail) => $mail->hasTo('owner@example.com')
            && $mail->hasReplyTo('jane@example.com'));
    }

    public function test_falls_back_to_site_settings_email(): void
    {
        Mail::fake();
        config(['mail.contact_receiver' => null]);
        SiteSetting::current()->update(['email' => 'site@example.com']);

        $this->post('/contact', $this->validPayload())->assertRedirect('/contact');

        Mail::assertSent(ContactMessageNotification::class, fn ($mail) => $mail->hasTo('site@example.com'));
    }

    public function test_honeypot_submissions_are_dropped(): void
    {
        Mail::fake();

        $this->post('/contact', $this->validPayload(['website' => 'http://spam.example']))
            ->assertRedirect('/contact');

        $this->assertSame(0, ContactMessage::count());
        Mail::assertNothingSent();
    }

    public function test_instant_submissions_are_dropped(): void
    {
        Mail::fake();

        $this->post('/contact', $this->validPayload(['form_token' => encrypt(now()->timestamp)]))
            ->assertRedirect('/contact');

        $this->assertSame(0, ContactMessage::count());
    }

    public function test_message_length_is_limited(): void
    {
        $this->post('/contact', $this->validPayload(['message' => str_repeat('a', 5001)]))
            ->assertSessionHasErrors('message');

        $this->assertSame(0, ContactMessage::count());
    }
}
