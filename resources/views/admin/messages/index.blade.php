<x-layouts.admin title="Messages">
    <x-admin.page-header title="Messages" description="Review contact form submissions and track their read status." />

    <div
        class="overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-zinc-50 dark:bg-zinc-800/50">
                    <tr class="text-left text-zinc-700 dark:text-zinc-300">
                        <th class="px-5 py-3.5 font-semibold">From</th>
                        <th class="px-5 py-3.5 font-semibold">Subject</th>
                        <th class="px-5 py-3.5 font-semibold">Date & Time</th>
                        <th class="px-5 py-3.5 font-semibold">Status</th>
                        <th class="px-5 py-3.5 font-semibold">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($messages as $m)
                        <tr class="border-t border-zinc-200 align-top dark:border-zinc-800">
                            <td class="px-5 py-4">
                                <div class="text-sm font-medium text-zinc-900 dark:text-white">
                                    {{ $m->name }}
                                </div>

                                <div class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">
                                    {{ $m->email }}
                                </div>
                            </td>

                            <td class="px-5 py-4 text-zinc-700 dark:text-zinc-300">
                                {{ $m->subject ?: '—' }}
                            </td>

                            <td class="px-5 py-4 text-zinc-700 dark:text-zinc-300">
                                {{ $m->created_at->timezone('Asia/Beirut')->format('M d, Y • h:i A') }}
                            </td>

                            <td class="px-5 py-4">
                                @if ($m->is_read)
                                    <span
                                        class="inline-flex rounded-full border border-zinc-300 bg-zinc-100 px-2.5 py-1 text-xs font-medium text-zinc-700 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                                        Read
                                    </span>
                                @else
                                    <span
                                        class="inline-flex rounded-full border border-blue-200 bg-blue-50 px-2.5 py-1 text-xs font-medium text-blue-700 dark:border-blue-900/40 dark:bg-blue-950/30 dark:text-blue-300">
                                        New
                                    </span>
                                @endif
                            </td>

                            <td class="px-5 py-4">
                                <a href="{{ route('messages.show', $m) }}"
                                    class="inline-flex items-center justify-center rounded-xl border border-zinc-300 bg-white px-3 py-1.5 text-sm font-medium text-zinc-900 transition hover:bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:hover:bg-zinc-700">
                                    Open
                                </a>

                                <div class="mt-2">
                                    <x-admin.delete-modal :action="route('messages.destroy', $m)" title="Delete message?"
                                        message="This will permanently remove the message." />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-12 text-center">
                                <div class="text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                    No messages yet.
                                </div>
                                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                                    Contact form submissions will appear here once visitors start sending messages.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($messages->hasPages())
        <div class="mt-6">
            {{ $messages->links() }}
        </div>
    @endif
</x-layouts.admin>
