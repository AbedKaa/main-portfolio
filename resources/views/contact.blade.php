<x-layouts.public title="Contact">
    <section class="section-block reveal-up">
        <div class="max-w-3xl">
            <h1 class="section-title">Contact</h1>
            <p class="section-subtitle">
                Get in touch for opportunities, collaborations, or any questions.
            </p>
        </div>

        @if (session('success'))
            <div
                class="mt-6 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-green-800 dark:border-green-900/50 dark:bg-green-950/40 dark:text-green-300">
                {{ session('success') }}
            </div>
        @endif

        <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-3">
            <div class="lg:col-span-2 card-panel interactive-card">
                <div class="card-body">
                    <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
                        @csrf

                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-zinc-300">
                                Name *
                            </label>
                            <input name="name" value="{{ old('name') }}"
                                class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-gray-900 outline-none transition focus:border-gray-400 focus:ring-2 focus:ring-gray-200 dark:border-zinc-700 dark:bg-zinc-950 dark:text-white dark:focus:border-zinc-500 dark:focus:ring-zinc-800" />
                            @error('name')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-zinc-300">
                                Email *
                            </label>
                            <input name="email" value="{{ old('email') }}"
                                class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-gray-900 outline-none transition focus:border-gray-400 focus:ring-2 focus:ring-gray-200 dark:border-zinc-700 dark:bg-zinc-950 dark:text-white dark:focus:border-zinc-500 dark:focus:ring-zinc-800" />
                            @error('email')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-zinc-300">
                                Subject
                            </label>
                            <input name="subject" value="{{ old('subject') }}"
                                class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-gray-900 outline-none transition focus:border-gray-400 focus:ring-2 focus:ring-gray-200 dark:border-zinc-700 dark:bg-zinc-950 dark:text-white dark:focus:border-zinc-500 dark:focus:ring-zinc-800" />
                            @error('subject')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-zinc-300">
                                Message *
                            </label>
                            <textarea name="message" rows="6"
                                class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-gray-900 outline-none transition focus:border-gray-400 focus:ring-2 focus:ring-gray-200 dark:border-zinc-700 dark:bg-zinc-950 dark:text-white dark:focus:border-zinc-500 dark:focus:ring-zinc-800">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <button class="primary-btn" type="submit">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>

            <div class="card-panel interactive-card">
                <div class="card-body">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Direct Links</h2>
                    <p class="mt-2 text-sm text-gray-600 dark:text-zinc-400">
                        You can also reach me directly through these platforms.
                    </p>

                    <div class="mt-5 space-y-4 text-sm">
                        @if ($settings->email)
                            <div>
                                <div class="font-medium text-gray-700 dark:text-zinc-300">Email</div>
                                <a class="mt-1 inline-flex text-gray-700 hover:text-black dark:text-zinc-300 dark:hover:text-white transition"
                                    href="mailto:{{ $settings->email }}">
                                    {{ $settings->email }}
                                </a>
                            </div>
                        @endif

                        @if ($settings->github_url)
                            <div>
                                <div class="font-medium text-gray-700 dark:text-zinc-300">GitHub</div>
                                <a class="mt-1 inline-flex break-all text-gray-700 hover:text-black dark:text-zinc-300 dark:hover:text-white transition"
                                    href="{{ $settings->github_url }}" target="_blank">
                                    {{ $settings->github_url }}
                                </a>
                            </div>
                        @endif

                        @if ($settings->linkedin_url)
                            <div>
                                <div class="font-medium text-gray-700 dark:text-zinc-300">LinkedIn</div>
                                <a class="mt-1 inline-flex break-all text-gray-700 hover:text-black dark:text-zinc-300 dark:hover:text-white transition"
                                    href="{{ $settings->linkedin_url }}" target="_blank">
                                    {{ $settings->linkedin_url }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.public>
