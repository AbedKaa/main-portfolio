<x-layouts.admin title="Site Settings">
    <div class="mx-auto max-w-5xl">
        <x-admin.page-header title="Site Settings"
            description="Update your personal info, contact links, SEO fields, uploaded media, and public section visibility." />

        @if (session('success'))
            <div
                class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-800 dark:border-green-900/40 dark:bg-green-950/30 dark:text-green-300">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
                <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-800">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Basic Information</h2>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Main profile details shown across the public portfolio.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Full Name *
                        </label>
                        <input name="full_name" value="{{ old('full_name', $settings->full_name) }}"
                            class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 outline-none transition focus:border-gray-400 focus:ring-2 focus:ring-gray-200 dark:border-gray-700 dark:bg-gray-950 dark:text-white dark:focus:border-gray-500 dark:focus:ring-gray-800" />
                        @error('full_name')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Headline
                        </label>
                        <input name="headline" value="{{ old('headline', $settings->headline) }}"
                            class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 outline-none transition focus:border-gray-400 focus:ring-2 focus:ring-gray-200 dark:border-gray-700 dark:bg-gray-950 dark:text-white dark:focus:border-gray-500 dark:focus:ring-gray-800" />
                        @error('headline')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="availability_status"
                            class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Availability Status
                        </label>
                        <input type="text" name="availability_status" id="availability_status"
                            value="{{ old('availability_status', $settings->availability_status) }}"
                            placeholder="Available for opportunities"
                            class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 outline-none transition focus:border-gray-400 focus:ring-2 focus:ring-gray-200 dark:border-gray-700 dark:bg-gray-950 dark:text-white dark:focus:border-gray-500 dark:focus:ring-gray-800" />
                        @error('availability_status')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Bio
                        </label>
                        <textarea name="bio" rows="6"
                            class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 outline-none transition focus:border-gray-400 focus:ring-2 focus:ring-gray-200 dark:border-gray-700 dark:bg-gray-950 dark:text-white dark:focus:border-gray-500 dark:focus:ring-gray-800">{{ old('bio', $settings->bio) }}</textarea>
                        @error('bio')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Email
                        </label>
                        <input name="email" value="{{ old('email', $settings->email) }}"
                            class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 outline-none transition focus:border-gray-400 focus:ring-2 focus:ring-gray-200 dark:border-gray-700 dark:bg-gray-950 dark:text-white dark:focus:border-gray-500 dark:focus:ring-gray-800" />
                        @error('email')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
                <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-800">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Links & SEO</h2>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        External profile links and metadata used for search and sharing.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            GitHub URL
                        </label>
                        <input name="github_url" value="{{ old('github_url', $settings->github_url) }}"
                            class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 outline-none transition focus:border-gray-400 focus:ring-2 focus:ring-gray-200 dark:border-gray-700 dark:bg-gray-950 dark:text-white dark:focus:border-gray-500 dark:focus:ring-gray-800" />
                        @error('github_url')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            LinkedIn URL
                        </label>
                        <input name="linkedin_url" value="{{ old('linkedin_url', $settings->linkedin_url) }}"
                            class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 outline-none transition focus:border-gray-400 focus:ring-2 focus:ring-gray-200 dark:border-gray-700 dark:bg-gray-950 dark:text-white dark:focus:border-gray-500 dark:focus:ring-gray-800" />
                        @error('linkedin_url')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Site Title
                        </label>
                        <input name="site_title" value="{{ old('site_title', $settings->site_title) }}"
                            class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 outline-none transition focus:border-gray-400 focus:ring-2 focus:ring-gray-200 dark:border-gray-700 dark:bg-gray-950 dark:text-white dark:focus:border-gray-500 dark:focus:ring-gray-800" />
                        @error('site_title')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Meta Description
                        </label>
                        <input name="meta_description"
                            value="{{ old('meta_description', $settings->meta_description) }}"
                            class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 outline-none transition focus:border-gray-400 focus:ring-2 focus:ring-gray-200 dark:border-gray-700 dark:bg-gray-950 dark:text-white dark:focus:border-gray-500 dark:focus:ring-gray-800" />
                        @error('meta_description')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
                <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-800">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Public Sections</h2>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Control which public sections are accessible on the live website.
                    </p>
                </div>

                <div class="p-6">
                    <label
                        class="flex items-start gap-3 rounded-xl border border-gray-200 bg-gray-50 p-4 dark:border-gray-800 dark:bg-gray-950/50">
                        <input type="checkbox" name="blog_enabled" value="1"
                            class="mt-1 h-4 w-4 rounded border-gray-300 text-gray-900 focus:ring-gray-400 dark:border-gray-600 dark:bg-gray-900 dark:text-white dark:focus:ring-gray-700"
                            {{ old('blog_enabled', $settings->blog_enabled ?? true) ? 'checked' : '' }}>
                        <div>
                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                Enable Blog
                            </div>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                When enabled, the public blog list and blog detail pages stay accessible.
                                When disabled, public blog routes should be hidden and blocked.
                            </p>
                        </div>
                    </label>
                    @error('blog_enabled')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
                <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-800">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Media Uploads</h2>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Manage portfolio media files used on the public site.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Profile Image
                        </label>
                        <input type="file" name="profile_image"
                            class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 dark:border-gray-700 dark:bg-gray-950 dark:text-white" />
                        @error('profile_image')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror

                        @if ($settings->profile_image)
                            <div class="mt-4">
                                <p
                                    class="mb-2 text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    Current Image
                                </p>
                                <img src="{{ asset('storage/' . $settings->profile_image) }}"
                                    class="h-24 w-24 rounded-full border border-gray-200 object-cover dark:border-gray-700" />
                            </div>
                        @endif
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            CV File (PDF)
                        </label>
                        <input type="file" name="cv_file"
                            class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 dark:border-gray-700 dark:bg-gray-950 dark:text-white" />
                        @error('cv_file')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror

                        @if ($settings->cv_file)
                            <a class="mt-4 inline-flex text-sm font-medium text-gray-700 transition hover:text-black dark:text-gray-300 dark:hover:text-white"
                                href="{{ asset('storage/' . $settings->cv_file) }}" target="_blank">
                                View current CV →
                            </a>
                        @endif
                    </div>

                    <div class="md:col-span-2">
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            OG Image (Social Preview)
                        </label>
                        <input type="file" name="og_image"
                            class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 dark:border-gray-700 dark:bg-gray-950 dark:text-white" />
                        @error('og_image')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror

                        @if ($settings->og_image)
                            <div class="mt-4">
                                <p
                                    class="mb-2 text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    Current OG Image
                                </p>
                                <img src="{{ asset('storage/' . $settings->og_image) }}"
                                    class="w-full max-w-md rounded-xl border border-gray-200 dark:border-gray-700" />
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button
                    class="inline-flex items-center justify-center rounded-lg bg-gray-900 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-black dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200"
                    type="submit">
                    Save Settings
                </button>
            </div>
        </form>
    </div>
</x-layouts.admin>
