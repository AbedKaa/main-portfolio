<x-layouts.admin title="Message">
    <div class="mx-auto max-w-4xl">
        <x-admin.page-header title="Message Details"
            description="Review the full contact message and sender information.">
            <x-slot:actions>
                <a href="{{ route('messages.index') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-zinc-300 bg-white px-4 py-2 text-sm font-medium text-zinc-900 transition hover:bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:hover:bg-zinc-700">
                    ← Back to Messages
                </a>
            </x-slot:actions>
        </x-admin.page-header>

        <div class="space-y-6">
            <div class="rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <div class="border-b border-zinc-200 px-6 py-4 dark:border-zinc-800">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">Sender Information</h2>
                            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                                Contact details and message metadata.
                            </p>
                        </div>

                        @if ($message->is_read)
                            <span
                                class="inline-flex w-fit rounded-full border border-zinc-300 bg-zinc-100 px-2.5 py-1 text-xs font-medium text-zinc-700 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                                Read
                            </span>
                        @else
                            <span
                                class="inline-flex w-fit rounded-full border border-blue-200 bg-blue-50 px-2.5 py-1 text-xs font-medium text-blue-700 dark:border-blue-900/40 dark:bg-blue-950/30 dark:text-blue-300">
                                New
                            </span>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">
                    <div>
                        <div class="text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">
                            From
                        </div>
                        <div class="mt-2 text-sm font-medium text-zinc-900 dark:text-white">
                            {{ $message->name }}
                        </div>
                    </div>

                    <div>
                        <div class="text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">
                            Email
                        </div>
                        <a href="mailto:{{ $message->email }}"
                            class="mt-2 inline-flex text-sm font-medium text-zinc-700 transition hover:text-black dark:text-zinc-300 dark:hover:text-white">
                            {{ $message->email }}
                        </a>
                    </div>

                    <div>
                        <div class="text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">
                            Date & Time
                        </div>
                        <div class="mt-2 text-sm text-zinc-700 dark:text-zinc-300">
                            {{ $message->created_at->timezone('Asia/Beirut')->format('M d, Y • h:i A') }}
                        </div>
                    </div>

                    <div>
                        <div class="text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">
                            Subject
                        </div>
                        <div class="mt-2 text-sm text-zinc-700 dark:text-zinc-300">
                            {{ $message->subject ?: '—' }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <div class="border-b border-zinc-200 px-6 py-4 dark:border-zinc-800">
                    <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">Message Content</h2>
                    <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                        Full message submitted from the public contact form.
                    </p>
                </div>

                <div class="p-6">
                    <div class="whitespace-pre-line text-sm leading-7 text-zinc-700 dark:text-zinc-300 sm:text-base">
                        {{ $message->message }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
