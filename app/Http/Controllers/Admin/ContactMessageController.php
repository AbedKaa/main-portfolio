<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ContactMessageNotification;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::orderByDesc('created_at')->get();

        return view('admin.messages.index', compact('messages'));
    }

    public function show(ContactMessage $message)
    {
        if (! $message->is_read) {
            $message->update([
                'is_read' => true,
            ]);
        }

        return view('admin.messages.show', compact('message'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        $contactMessage = ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'] ?? null,
            'message' => $validated['message'],
            'is_read' => false,
        ]);

        try {
            Mail::to(env('CONTACT_RECEIVER_EMAIL'))->send(
                new ContactMessageNotification($contactMessage)
            );
        } catch (\Throwable $e) {
            Log::error('Contact email notification failed.', [
                'message_id' => $contactMessage->id,
                'error' => $e->getMessage(),
            ]);
        }

        return redirect()
            ->route('contact')
            ->with('success', 'Your message has been sent successfully.');
    }
}
