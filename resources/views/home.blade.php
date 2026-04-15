<x-layouts.public title="Home">
    <section class="section-block reveal-up">
        <div class="grid gap-8 lg:grid-cols-2 lg:items-center">
            <div>
                @if ($settings->availability_status)
                    <p class="tag-pill mb-4">{{ $settings->availability_status }}</p>
                @endif

                <p class="text-sm text-gray-500 dark:text-zinc-400">Hi, I’m</p>

                <h1 class="mt-2 text-4xl sm:text-5xl font-bold tracking-tight text-gray-900 dark:text-white">
                    {{ $settings->full_name ?? ($settings->name ?? 'Your Name') }}
                </h1>

                @if ($settings->headline)
                    <p class="mt-4 text-base sm:text-lg font-medium text-gray-700 dark:text-zinc-300">
                        {{ $settings->headline }}
                    </p>
                @endif

                @if ($settings->bio)
                    <p class="mt-4 text-base sm:text-lg leading-8 text-gray-600 dark:text-zinc-400">
                        {{ $settings->bio }}
                    </p>
                @endif

                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('projects.public.index') }}" class="primary-btn">
                        View Projects
                    </a>

                    @if ($settings->cv_file)
                        <a href="{{ asset('storage/' . $settings->cv_file) }}" target="_blank" class="secondary-btn">
                            Download CV
                        </a>
                    @endif

                    @if ($settings->github_url)
                        <a href="{{ $settings->github_url }}" target="_blank" class="secondary-btn">
                            GitHub
                        </a>
                    @endif

                    @if ($settings->linkedin_url)
                        <a href="{{ $settings->linkedin_url }}" target="_blank" class="secondary-btn">
                            LinkedIn
                        </a>
                    @endif

                    <a href="{{ route('login') }}" class="secondary-btn">
                        Admin
                    </a>
                </div>
            </div>

            <div class="card-panel">
                <div class="card-body">
                    @if ($settings->profile_image)
                        <img src="{{ asset('storage/' . $settings->profile_image) }}"
                            alt="{{ $settings->full_name ?? ($settings->name ?? 'Profile') }}"
                            class="w-full max-w-sm mx-auto rounded-2xl border border-gray-200 dark:border-zinc-800 object-cover">
                    @else
                        <div
                            class="flex min-h-[320px] items-center justify-center rounded-2xl border border-dashed border-gray-300 dark:border-zinc-700 text-gray-500 dark:text-zinc-500">
                            Profile image
                        </div>
                    @endif
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
