@php
    $isEdit = isset($post);
@endphp

<div class="space-y-6">
    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
            Title *
        </label>
        <input name="title" value="{{ old('title', $post->title ?? '') }}"
            class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 outline-none transition focus:border-gray-400 focus:ring-2 focus:ring-gray-200 dark:border-gray-700 dark:bg-gray-950 dark:text-white dark:focus:border-gray-500 dark:focus:ring-gray-800" />
        @error('title')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
            Excerpt
        </label>
        <textarea name="excerpt" rows="3"
            class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 outline-none transition focus:border-gray-400 focus:ring-2 focus:ring-gray-200 dark:border-gray-700 dark:bg-gray-950 dark:text-white dark:focus:border-gray-500 dark:focus:ring-gray-800">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
        @error('excerpt')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
            Content
        </label>
        <textarea name="content" rows="10"
            class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 outline-none transition focus:border-gray-400 focus:ring-2 focus:ring-gray-200 dark:border-gray-700 dark:bg-gray-950 dark:text-white dark:focus:border-gray-500 dark:focus:ring-gray-800">{{ old('content', $post->content ?? '') }}</textarea>
        @error('content')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
        <div>
            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                Sort Order
            </label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $post->sort_order ?? 0) }}"
                class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 outline-none transition focus:border-gray-400 focus:ring-2 focus:ring-gray-200 dark:border-gray-700 dark:bg-gray-950 dark:text-white dark:focus:border-gray-500 dark:focus:ring-gray-800" />
            @error('sort_order')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <label
            class="inline-flex items-center gap-3 rounded-xl border border-gray-200 px-4 py-3 md:mt-8 dark:border-gray-800">
            <input type="checkbox" name="is_published" value="1"
                {{ old('is_published', $post->is_published ?? false) ? 'checked' : '' }}
                class="rounded border-gray-300 text-gray-900 focus:ring-gray-300 dark:border-gray-700 dark:bg-gray-950">
            <div>
                <span class="block text-sm font-medium text-gray-900 dark:text-white">Published</span>
                <span class="block text-xs text-gray-500 dark:text-gray-400">Show this post on the public blog.</span>
            </div>
        </label>
    </div>
</div>
