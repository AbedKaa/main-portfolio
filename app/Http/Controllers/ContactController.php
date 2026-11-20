<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessageNotification;
use App\Models\ContactMessage;
use App\Models\SiteSetting;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /** Submissions faster than this (in seconds) are treated as bots. */
    private const MIN_FILL_SECONDS = 3;

    public function store(Request $request): RedirectResponse
    {
        $successMessage = 'Your message has been sent successfully.';

        if ($this->looksLikeSpam($request)) {
            // Pretend it worked so bots get no signal to adapt.
            return redirect()->route('contact')->with('success', $successMessage);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        $contactMessage = ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'] ?? null,
            'message' => $validated['message'],
            'is_read' => false,
        ]);

        $receiver = config('mail.contact_receiver') ?: SiteSetting::current()->email;

        if (! $receiver) {
            Log::warning('Contact message saved but not emailed: no CONTACT_RECEIVER_EMAIL or site email configured.', [
                'message_id' => $contactMessage->id,
            ]);
        } else {
            try {
                Mail::to($receiver)->send(new ContactMessageNotification($contactMessage));
            } catch (\Throwable $e) {
                // The message is already stored and visible in the admin panel.
                Log::error('Contact email notification failed.', [
                    'message_id' => $contactMessage->id,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        return redirect()->route('contact')->with('success', $successMessage);
    }

    private function looksLikeSpam(Request $request): bool
    {
        if (filled($request->input('website'))) {
            return true;
        }

        try {
            $startedAt = (int) decrypt((string) $request->input('form_token'));
        } catch (DecryptException) {
            return true;
        }

        return now()->timestamp - $startedAt < self::MIN_FILL_SECONDS;
    }
}
