<x-layouts.admin title="Edit Project">
    <div class="mx-auto max-w-5xl">
        <x-admin.page-header title="Edit Project"
            subtitle="Update the project content, links, cover image, gallery, and visibility settings.">
            <x-slot:actions>
                <a href="{{ route('projects.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-900 transition hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700">
                    ← Back to Projects
                </a>
            </x-slot:actions>
        </x-admin.page-header>

        @if (session('success'))
            <div
                class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-800 dark:border-green-900/40 dark:bg-green-950/30 dark:text-green-300">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
                <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-800">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Project Details</h2>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Edit the main project information displayed on the public website.
                    </p>
                </div>

                <div class="p-6">
                    <form method="POST" action="{{ route('projects.update', $project) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @include('admin.projects._form', ['project' => $project])

                        <div class="mt-8 flex flex-wrap gap-3">
                            <button
                                class="inline-flex items-center justify-center rounded-lg bg-gray-900 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-black dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200"
                                type="submit">
                                Update Project
                            </button>

                            <a href="{{ route('projects.index') }}"
                                class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 transition hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
                <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-800">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Project Gallery</h2>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Upload screenshots and visual previews for this project.
                    </p>
                </div>

                <div class="p-6">
                    <form method="POST" action="{{ route('projects.images.store', $project) }}"
                        enctype="multipart/form-data">
                        @csrf

                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Upload screenshots (multiple)
                            </label>

                            <input type="file" name="images[]" multiple
                                class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 dark:border-gray-700 dark:bg-gray-950 dark:text-white" />

                            @error('images')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror

                            @error('images.*')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <button
                            class="mt-4 inline-flex items-center justify-center rounded-lg bg-gray-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-black dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200"
                            type="submit">
                            Upload Images
                        </button>
                    </form>

                    <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        @forelse ($project->images as $img)
                            <div class="overflow-hidden rounded-xl border border-gray-200 dark:border-gray-800">
                                <img src="{{ asset('storage/' . $img->image_path) }}" class="h-32 w-full object-cover"
                                    alt="Project gallery image" />

                                <div class="p-3">
                                    <form method="POST" action="{{ route('projects.images.destroy', $img) }}"
                                        onsubmit="return confirm('Remove this image?');">
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="w-full rounded-lg border border-red-200 px-3 py-2 text-sm font-medium text-red-600 transition hover:bg-red-50 dark:border-red-900/40 dark:text-red-400 dark:hover:bg-red-950/30"
                                            type="submit">
                                            Remove
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                No gallery images uploaded yet.
                            </p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-red-200 bg-white dark:border-red-900/40 dark:bg-gray-900">
                <div class="border-b border-red-200 px-6 py-4 dark:border-red-900/40">
                    <h2 class="text-lg font-semibold text-red-600 dark:text-red-400">Danger Zone</h2>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Permanently delete this project and remove it from your portfolio.
                    </p>
                </div>

                <div class="p-6">
                    <form method="POST" action="{{ route('projects.destroy', $project) }}"
                        onsubmit="return confirm('Delete this project?');">
                        @csrf
                        @method('DELETE')

                        <button
                            class="inline-flex items-center justify-center rounded-lg border border-red-200 px-4 py-2 text-sm font-medium text-red-600 transition hover:bg-red-50 dark:border-red-900/40 dark:text-red-400 dark:hover:bg-red-950/30"
                            type="submit">
                            Delete Project
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
