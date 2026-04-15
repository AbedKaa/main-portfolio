<x-layouts.admin title="Create Post">
    <div class="mx-auto max-w-5xl">
        <x-admin.page-header title="Create Post"
            subtitle="Add a new blog post with content, excerpt, publishing status, and display order.">
            <x-slot:actions>
                <a href="{{ route('posts.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-900 transition hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700">
                    ← Back to Posts
                </a>
            </x-slot:actions>
        </x-admin.page-header>

        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-800">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Post Details</h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Fill in the article content and publishing settings for the blog.
                </p>
            </div>

            <div class="p-6">
                <form method="POST" action="{{ route('posts.store') }}">
                    @csrf

                    @include('admin.posts._form')

                    <div class="mt-8 flex flex-wrap gap-3">
                        <button
                            class="inline-flex items-center justify-center rounded-lg bg-gray-900 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-black dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200"
                            type="submit">
                            Save Post
                        </button>

                        <a href="{{ route('posts.index') }}"
                            class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 transition hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>
