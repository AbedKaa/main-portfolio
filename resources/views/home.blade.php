<x-layouts.public title="Home">
    <section class="section-block reveal-up">
        <div class="grid gap-10 lg:grid-cols-2 lg:items-center">
            <div>
                @if ($settings->availability_status)
                    <div
                        class="mb-5 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-sm font-medium text-emerald-700 shadow-sm dark:border-emerald-900/40 dark:bg-emerald-950/30 dark:text-emerald-300">
                        <span class="relative flex h-2.5 w-2.5">
                            <span
                                class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
                        </span>
                        {{ $settings->availability_status }}
                    </div>
                @endif

                <p class="text-sm font-medium uppercase tracking-[0.3em] text-gray-500 dark:text-zinc-400">
                    Hi, I’m
                </p>

                <h1 class="mt-3 text-4xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-6xl">
                    {{ $settings->full_name ?? ($settings->name ?? 'Your Name') }}
                </h1>

                @if ($settings->headline)
                    <p class="mt-5 max-w-2xl text-lg font-medium leading-8 text-gray-700 dark:text-zinc-300 sm:text-xl">
                        {{ $settings->headline }}
                    </p>
                @endif

                @if ($settings->bio)
                    <p class="mt-5 max-w-2xl text-base leading-8 text-gray-600 dark:text-zinc-400 sm:text-lg">
                        {{ $settings->bio }}
                    </p>
                @endif

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('projects.public.index') }}" class="primary-btn">
                        View Projects
                    </a>

                    <a href="{{ route('contact') }}" class="secondary-btn">
                        Contact Me
                    </a>

                    @if ($settings->cv_file)
                        <a href="{{ asset('storage/' . $settings->cv_file) }}" target="_blank" class="secondary-btn">
                            Download CV
                        </a>
                    @endif

                    @if ($settings->github_url)
                        <a href="{{ $settings->github_url }}" target="_blank" rel="noopener noreferrer"
                            class="secondary-btn">
                            GitHub
                        </a>
                    @endif

                    @if ($settings->linkedin_url)
                        <a href="{{ $settings->linkedin_url }}" target="_blank" rel="noopener noreferrer"
                            class="secondary-btn">
                            LinkedIn
                        </a>
                    @endif
                </div>

                <div class="mt-10 grid grid-cols-3 gap-3 max-w-lg">
                    <div
                        class="rounded-2xl border border-gray-200 bg-white/70 p-4 text-center shadow-sm backdrop-blur dark:border-zinc-800 dark:bg-zinc-900/70">
                        <div class="text-2xl font-semibold text-gray-900 dark:text-white">
                            {{ $featuredProjects->count() }}
                        </div>
                        <div class="mt-1 text-xs text-gray-500 dark:text-zinc-400">
                            Featured Projects
                        </div>
                    </div>

                    <div
                        class="rounded-2xl border border-gray-200 bg-white/70 p-4 text-center shadow-sm backdrop-blur dark:border-zinc-800 dark:bg-zinc-900/70">
                        <div class="text-2xl font-semibold text-gray-900 dark:text-white">
                            CMS
                        </div>
                        <div class="mt-1 text-xs text-gray-500 dark:text-zinc-400">
                            Controlled
                        </div>
                    </div>

                    <div
                        class="rounded-2xl border border-gray-200 bg-white/70 p-4 text-center shadow-sm backdrop-blur dark:border-zinc-800 dark:bg-zinc-900/70">
                        <div class="text-2xl font-semibold text-gray-900 dark:text-white">
                            {{ $experienceCount }}
                        </div>
                        <div class="mt-1 text-xs text-gray-500 dark:text-zinc-400">
                            Experience
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative">
                <div
                    class="absolute -inset-4 rounded-[2rem] bg-gradient-to-br from-blue-400/20 via-purple-400/20 to-emerald-400/20 blur-2xl">
                </div>

                <div class="card-panel interactive-card relative overflow-hidden">
                    <div
                        class="absolute right-5 top-5 z-10 rounded-full border border-white/40 bg-white/70 px-3 py-1 text-xs font-medium text-gray-700 shadow-sm backdrop-blur dark:border-zinc-700/60 dark:bg-zinc-900/70 dark:text-zinc-300">
                        Portfolio
                    </div>

                    <div class="card-body">
                        @if ($settings->profile_image)
                            <img src="{{ asset('storage/' . $settings->profile_image) }}"
                                alt="{{ $settings->full_name ?? ($settings->name ?? 'Profile') }}"
                                class="mx-auto aspect-[4/5] w-full max-w-sm rounded-2xl border border-gray-200 object-cover shadow-sm dark:border-zinc-800">
                        @else
                            <div
                                class="flex min-h-[360px] items-center justify-center rounded-2xl border border-dashed border-gray-300 text-gray-500 dark:border-zinc-700 dark:text-zinc-500">
                                Profile image
                            </div>
                        @endif
                    </div>
                </div>

                <div
                    class="absolute -bottom-5 left-4 hidden rounded-2xl border border-gray-200 bg-white/80 p-4 shadow-lg backdrop-blur dark:border-zinc-800 dark:bg-zinc-900/80 sm:block">
                    <p class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-zinc-400">
                        Built with
                    </p>
                    <p class="mt-1 text-sm font-semibold text-gray-900 dark:text-white">
                        Laravel · Blade · Tailwind
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="section-block reveal-up">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="section-title">Featured Projects</h2>
                <p class="section-subtitle">A few highlighted works from the portfolio.</p>
            </div>

            <a href="{{ route('projects.public.index') }}" class="soft-link text-sm">
                View all
            </a>
        </div>

        <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-3">
            @forelse ($featuredProjects as $project)
                <a href="{{ route('projects.public.show', $project->slug) }}"
                    class="card-panel interactive-card flex h-full flex-col overflow-hidden hover:border-gray-300 dark:hover:border-zinc-700">
                    @if ($project->cover_image)
                        <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->title }}"
                            class="h-48 w-full object-cover">
                    @endif

                    <div class="card-body flex flex-1 flex-col">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $project->title }}
                        </h3>

                        @if ($project->short_description)
                            <p class="mt-3 line-clamp-3 text-sm leading-6 text-gray-600 dark:text-zinc-400">
                                {{ $project->short_description }}
                            </p>
                        @else
                            <p class="mt-3 text-sm leading-6 text-gray-500 dark:text-zinc-500">
                                No description available.
                            </p>
                        @endif

                        <div class="mt-5 flex flex-wrap gap-2">
                            @if ($project->tech_stack)
                                @foreach (explode(',', $project->tech_stack) as $tech)
                                    <span class="tag-pill">{{ trim($tech) }}</span>
                                @endforeach
                            @else
                                <span class="text-xs text-gray-500 dark:text-zinc-500">
                                    No tech stack listed
                                </span>
                            @endif
                        </div>

                        <div class="mt-auto pt-6">
                            <span class="text-sm font-medium text-gray-700 dark:text-zinc-300">
                                View →
                            </span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="md:col-span-3">
                    <p
                        class="rounded-2xl border border-dashed border-gray-300 px-6 py-10 text-center text-gray-600 dark:border-zinc-700 dark:text-zinc-400">
                        No projects yet.
                    </p>
                </div>
            @endforelse
        </div>
    </section>
</x-layouts.public>
