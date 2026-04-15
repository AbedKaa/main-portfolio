<x-layouts.admin title="Projects">
    <x-admin.page-header title="Projects"
        description="Manage your portfolio projects, publishing status, and display order.">
        <x-slot:actions>
            <a href="{{ route('projects.create') }}"
                class="inline-flex items-center justify-center rounded-lg bg-gray-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-black dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200">
                + New Project
            </a>
        </x-slot:actions>
    </x-admin.page-header>

    @if (session('success'))
        <div
            class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-800 dark:border-green-900/40 dark:bg-green-950/30 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6 rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900">
        <form method="GET" action="{{ route('projects.index') }}"
            class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div class="w-full sm:max-w-xs">
                <label for="status" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Filter by status
                </label>
                <select id="status" name="status"
                    class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 outline-none transition focus:border-gray-500 focus:ring-2 focus:ring-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:focus:border-gray-500 dark:focus:ring-gray-700">
                    <option value="">All</option>
                    <option value="published" {{ $status === 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ $status === 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>

            <div class="flex gap-3">
                <button type="submit"
                    class="inline-flex items-center justify-center rounded-xl bg-gray-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-black dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200">
                    Apply Filter
                </button>

                <a href="{{ route('projects.index') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <div class="overflow-x-auto rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-800/50">
                <tr class="text-left text-gray-700 dark:text-gray-300">
                    <th class="px-4 py-3 font-semibold">Title</th>
                    <th class="px-4 py-3 font-semibold">Published</th>
                    <th class="px-4 py-3 font-semibold">Sort</th>
                    <th class="px-4 py-3 font-semibold">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($projects as $project)
                    <tr class="border-t border-gray-200 align-top dark:border-gray-800">
                        <td class="px-4 py-4">
                            <div class="font-medium text-gray-900 dark:text-white">
                                {{ $project->title }}
                            </div>
                            <div class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                {{ $project->slug }}
                            </div>
                        </td>

                        <td class="px-4 py-4">
                            @if ($project->is_published)
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

                        <td class="px-4 py-4 text-gray-700 dark:text-gray-300">
                            {{ $project->sort_order }}
                        </td>

                        <td class="px-4 py-4">
                            <div class="flex items-center gap-4">
                                <a class="text-sm font-medium text-gray-700 transition hover:text-black dark:text-gray-300 dark:hover:text-white"
                                    href="{{ route('projects.edit', $project) }}">
                                    Edit
                                </a>

                                <x-admin.delete-modal :action="route('projects.destroy', $project)" title="Delete project?"
                                    message="This will permanently remove the project from your portfolio." />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-4 py-8 text-center text-gray-600 dark:text-gray-400" colspan="4">
                            No projects found for this filter.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if ($projects->hasPages())
            <div class="mt-6">
                {{ $projects->links() }}
            </div>
        @endif
    </div>
</x-layouts.admin>
