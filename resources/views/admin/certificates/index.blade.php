<x-layouts.admin title="Certificates">
    <x-admin.page-header title="Certificates" subtitle="Manage your certifications, issuers, dates, and visibility.">
        <x-slot:actions>
            <a href="{{ route('certificates.create') }}"
                class="inline-flex items-center justify-center rounded-lg bg-gray-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-black dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200">
                + New Certificate
            </a>
        </x-slot:actions>
    </x-admin.page-header>

    @if (session('success'))
        <div
            class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-800 dark:border-green-900/40 dark:bg-green-950/30 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-800/50">
                <tr class="text-left text-gray-700 dark:text-gray-300">
                    <th class="px-4 py-3 font-semibold">Title</th>
                    <th class="px-4 py-3 font-semibold">Issuer</th>
                    <th class="px-4 py-3 font-semibold">Date</th>
                    <th class="px-4 py-3 font-semibold">Visible</th>
                    <th class="px-4 py-3 font-semibold">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($certificates as $c)
                    <tr class="border-t border-gray-200 align-top dark:border-gray-800">
                        <td class="px-4 py-4 font-medium text-gray-900 dark:text-white">
                            {{ $c->title }}
                        </td>

                        <td class="px-4 py-4 text-gray-700 dark:text-gray-300">
                            {{ $c->issuer ?: '—' }}
                        </td>

                        <td class="px-4 py-4 text-gray-700 dark:text-gray-300">
                            {{ $c->issue_date ? \Carbon\Carbon::parse($c->issue_date)->format('M Y') : '—' }}
                        </td>

                        <td class="px-4 py-4">
                            @if ($c->is_visible)
                                <span
                                    class="inline-flex rounded-full border border-green-200 bg-green-50 px-2.5 py-1 text-xs font-medium text-green-700 dark:border-green-900/40 dark:bg-green-950/30 dark:text-green-300">
                                    Yes
                                </span>
                            @else
                                <span
                                    class="inline-flex rounded-full border border-gray-300 bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                                    No
                                </span>
                            @endif
                        </td>

                        <td class="px-4 py-4">
                            <div class="flex items-center gap-4">
                                <a class="text-sm font-medium text-gray-700 transition hover:text-black dark:text-gray-300 dark:hover:text-white"
                                    href="{{ route('certificates.edit', $c) }}">
                                    Edit
                                </a>

                                <x-admin.delete-modal :action="route('certificates.destroy', $c)" title="Delete certificate?"
                                    message="This will permanently remove the certificate." />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-gray-600 dark:text-gray-400">
                            No certificates yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.admin>
