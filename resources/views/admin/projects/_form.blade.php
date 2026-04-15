@php
    $isEdit = isset($project);
@endphp

<div class="space-y-6">
    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
        <div class="md:col-span-2">
            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                Title *
            </label>
            <input name="title" value="{{ old('title', $project->title ?? '') }}"
                class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 outline-none transition focus:border-gray-400 focus:ring-2 focus:ring-gray-200 dark:border-gray-700 dark:bg-gray-950 dark:text-white dark:focus:border-gray-500 dark:focus:ring-gray-800" />
            @error('title')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="md:col-span-2">
            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                Short Description
            </label>
            <textarea name="short_description" rows="3"
                class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 outline-none transition focus:border-gray-400 focus:ring-2 focus:ring-gray-200 dark:border-gray-700 dark:bg-gray-950 dark:text-white dark:focus:border-gray-500 dark:focus:ring-gray-800">{{ old('short_description', $project->short_description ?? '') }}</textarea>
            @error('short_description')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="md:col-span-2">
            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                Content
            </label>
            <textarea name="content" rows="8"
                class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 outline-none transition focus:border-gray-400 focus:ring-2 focus:ring-gray-200 dark:border-gray-700 dark:bg-gray-950 dark:text-white dark:focus:border-gray-500 dark:focus:ring-gray-800">{{ old('content', $project->content ?? '') }}</textarea>
            @error('content')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                Tech Stack
            </label>
            <input name="tech_stack" value="{{ old('tech_stack', $project->tech_stack ?? '') }}"
                placeholder="Laravel, Tailwind, Alpine, MySQL"
                class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 outline-none transition focus:border-gray-400 focus:ring-2 focus:ring-gray-200 dark:border-gray-700 dark:bg-gray-950 dark:text-white dark:focus:border-gray-500 dark:focus:ring-gray-800" />
            @error('tech_stack')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                Sort Order
            </label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $project->sort_order ?? 0) }}"
                class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 outline-none transition focus:border-gray-400 focus:ring-2 focus:ring-gray-200 dark:border-gray-700 dark:bg-gray-950 dark:text-white dark:focus:border-gray-500 dark:focus:ring-gray-800" />
            @error('sort_order')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                GitHub URL
            </label>
            <input name="github_url" value="{{ old('github_url', $project->github_url ?? '') }}"
                class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 outline-none transition focus:border-gray-400 focus:ring-2 focus:ring-gray-200 dark:border-gray-700 dark:bg-gray-950 dark:text-white dark:focus:border-gray-500 dark:focus:ring-gray-800" />
            @error('github_url')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                Demo URL
            </label>
            <input name="demo_url" value="{{ old('demo_url', $project->demo_url ?? '') }}"
                class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 outline-none transition focus:border-gray-400 focus:ring-2 focus:ring-gray-200 dark:border-gray-700 dark:bg-gray-950 dark:text-white dark:focus:border-gray-500 dark:focus:ring-gray-800" />
            @error('demo_url')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="md:col-span-2">
            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                Cover Image
            </label>
            <input type="file" name="cover_image"
                class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 dark:border-gray-700 dark:bg-gray-950 dark:text-white" />
            @error('cover_image')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror

            @if ($isEdit && $project->cover_image)
                <div class="mt-4">
                    <p class="mb-2 text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">
                        Current Cover
                    </p>
                    <img src="{{ asset('storage/' . $project->cover_image) }}"
                        class="h-28 w-48 rounded-xl border border-gray-200 object-cover dark:border-gray-700"
                        alt="Cover image" />
                </div>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
        <label class="inline-flex items-center gap-3 rounded-xl border border-gray-200 px-4 py-3 dark:border-gray-800">
            <input type="checkbox" name="is_published" value="1"
                {{ old('is_published', $project->is_published ?? true) ? 'checked' : '' }}
                class="rounded border-gray-300 text-gray-900 focus:ring-gray-300 dark:border-gray-700 dark:bg-gray-950">
            <div>
                <span class="block text-sm font-medium text-gray-900 dark:text-white">Published</span>
                <span class="block text-xs text-gray-500 dark:text-gray-400">Show this project on the public
                    website.</span>
            </div>
        </label>

        <label class="inline-flex items-center gap-3 rounded-xl border border-gray-200 px-4 py-3 dark:border-gray-800">
            <input type="checkbox" name="is_featured" value="1"
                {{ old('is_featured', $project->is_featured ?? false) ? 'checked' : '' }}
                class="rounded border-gray-300 text-gray-900 focus:ring-gray-300 dark:border-gray-700 dark:bg-gray-950">
            <div>
                <span class="block text-sm font-medium text-gray-900 dark:text-white">Featured</span>
                <span class="block text-xs text-gray-500 dark:text-gray-400">Highlight this project on the home
                    page.</span>
            </div>
        </label>
    </div>
</div>
