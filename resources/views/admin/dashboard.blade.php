<x-layouts.admin title="Dashboard">
    <x-admin.page-header title="Dashboard"
        description="Manage your portfolio content, settings, and public website data from one place." />

    <div class="space-y-6">
        <div class="rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <p class="text-sm text-zinc-600 dark:text-zinc-300">
                Welcome to your admin dashboard.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-2xl border border-zinc-200 bg-white p-5 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <div class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Projects</div>
                <div class="mt-2 text-3xl font-semibold text-zinc-900 dark:text-white">
                    {{ $stats['projects'] }}
                </div>
            </div>

            <div
                class="rounded-2xl border border-zinc-200 bg-white p-5 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <div class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Blog Posts</div>
                <div class="mt-2 text-3xl font-semibold text-zinc-900 dark:text-white">
                    {{ $stats['posts'] }}
                </div>
            </div>

            <div
                class="rounded-2xl border border-zinc-200 bg-white p-5 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <div class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Skills</div>
                <div class="mt-2 text-3xl font-semibold text-zinc-900 dark:text-white">
                    {{ $stats['skills'] }}
                </div>
            </div>

            <div
                class="rounded-2xl border border-zinc-200 bg-white p-5 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <div class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Unread Messages</div>
                <div class="mt-2 text-3xl font-semibold text-zinc-900 dark:text-white">
                    {{ $stats['unreadMessages'] }}
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <div class="border-b border-zinc-200 px-6 py-4 dark:border-zinc-800">
                <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">Quick Actions</h2>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                    Jump directly to the most common content actions.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-3 p-6 sm:grid-cols-2 xl:grid-cols-4">
                <a href="{{ route('projects.create') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-zinc-300 bg-white px-4 py-3 text-sm font-medium text-zinc-900 transition hover:bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:hover:bg-zinc-700">
                    + New Project
                </a>

                <a href="{{ route('posts.create') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-zinc-300 bg-white px-4 py-3 text-sm font-medium text-zinc-900 transition hover:bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:hover:bg-zinc-700">
                    + New Post
                </a>

                <a href="{{ route('skills.create') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-zinc-300 bg-white px-4 py-3 text-sm font-medium text-zinc-900 transition hover:bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:hover:bg-zinc-700">
                    + New Skill
                </a>

                <a href="{{ route('messages.index') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-zinc-300 bg-white px-4 py-3 text-sm font-medium text-zinc-900 transition hover:bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:hover:bg-zinc-700">
                    View Messages
                </a>

                <a href="{{ route('experiences.create') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-zinc-300 bg-white px-4 py-3 text-sm font-medium text-zinc-900 transition hover:bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:hover:bg-zinc-700">
                    + New Experience
                </a>

                <a href="{{ route('certificates.create') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-zinc-300 bg-white px-4 py-3 text-sm font-medium text-zinc-900 transition hover:bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:hover:bg-zinc-700">
                    + New Certificate
                </a>

                <a href="{{ route('admin.settings.edit') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-zinc-300 bg-white px-4 py-3 text-sm font-medium text-zinc-900 transition hover:bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:hover:bg-zinc-700">
                    Edit Settings
                </a>

                <a href="{{ route('projects.index') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-zinc-300 bg-white px-4 py-3 text-sm font-medium text-zinc-900 transition hover:bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:hover:bg-zinc-700">
                    Manage Projects
                </a>
            </div>
        </div>

        <div class="rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <div class="border-b border-zinc-200 px-6 py-4 dark:border-zinc-800">
                <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">Content Overview</h2>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                    A quick summary of the rest of your portfolio content.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-4 p-6 sm:grid-cols-2 xl:grid-cols-4">
                <div class="rounded-xl border border-zinc-200 bg-zinc-50 p-4 dark:border-zinc-800 dark:bg-zinc-950/50">
                    <div class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Experiences</div>
                    <div class="mt-2 text-2xl font-semibold text-zinc-900 dark:text-white">
                        {{ $stats['experiences'] }}
                    </div>
                </div>

                <div class="rounded-xl border border-zinc-200 bg-zinc-50 p-4 dark:border-zinc-800 dark:bg-zinc-950/50">
                    <div class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Certificates</div>
                    <div class="mt-2 text-2xl font-semibold text-zinc-900 dark:text-white">
                        {{ $stats['certificates'] }}
                    </div>
                </div>

                <div class="rounded-xl border border-zinc-200 bg-zinc-50 p-4 dark:border-zinc-800 dark:bg-zinc-950/50">
                    <div class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Total Messages</div>
                    <div class="mt-2 text-2xl font-semibold text-zinc-900 dark:text-white">
                        {{ $stats['messages'] }}
                    </div>
                </div>

                <div class="rounded-xl border border-zinc-200 bg-zinc-50 p-4 dark:border-zinc-800 dark:bg-zinc-950/50">
                    <div class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Published Content</div>
                    <div class="mt-2 text-2xl font-semibold text-zinc-900 dark:text-white">
                        {{ $stats['projects'] + $stats['posts'] + $stats['skills'] + $stats['experiences'] + $stats['certificates'] }}
                    </div>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <div
                class="flex flex-col gap-3 border-b border-zinc-200 px-6 py-4 dark:border-zinc-800 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">Recent Messages</h2>
                    <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                        Quickly review the latest contact form submissions.
                    </p>
                </div>

                <a href="{{ route('messages.index') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-zinc-300 bg-white px-4 py-2 text-sm font-medium text-zinc-900 transition hover:bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:hover:bg-zinc-700">
                    View All Messages
                </a>
            </div>

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
                        @forelse($recentMessages as $message)
                            <tr class="border-t border-zinc-200 align-top dark:border-zinc-800">
                                <td class="px-5 py-4">
                                    <div class="text-sm font-medium text-zinc-900 dark:text-white">
                                        {{ $message->name }}
                                    </div>
                                    <div class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">
                                        {{ $message->email }}
                                    </div>
                                </td>

                                <td class="px-5 py-4 text-zinc-700 dark:text-zinc-300">
                                    {{ $message->subject ?: '—' }}
                                </td>

                                <td class="px-5 py-4 text-zinc-700 dark:text-zinc-300">
                                    {{ $message->created_at->timezone('Asia/Beirut')->format('M d, Y • h:i A') }}
                                </td>

                                <td class="px-5 py-4">
                                    @if ($message->is_read)
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
                                    <a href="{{ route('messages.show', $message) }}"
                                        class="inline-flex items-center justify-center rounded-xl border border-zinc-300 bg-white px-3 py-1.5 text-sm font-medium text-zinc-900 transition hover:bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:hover:bg-zinc-700">
                                        Open
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-5 py-12 text-center">
                                    <div class="text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                        No recent messages found.
                                    </div>
                                    <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                                        New contact form submissions will appear here.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.admin>
