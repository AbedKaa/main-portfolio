<x-layouts.public :title="$project->title">
    <section class="section-block reveal-up">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="section-title">{{ $project->title }}</h1>

                @if ($project->short_description)
                    <p class="section-subtitle mt-3">
                        {{ $project->short_description }}
                    </p>
                @endif
            </div>

            <a
                href="{{ route('projects.public.index') }}"
                class="secondary-btn"
            >
                ← Back to Projects
            </a>
        </div>

        <div class="mt-8 card-panel interactive-card overflow-hidden">
            @if ($project->cover_image)
                <img
                    src="{{ asset('storage/' . $project->cover_image) }}"
                    alt="{{ $project->title }}"
                    class="h-72 w-full object-cover sm:h-80 lg:h-[26rem]"
                />
            @endif

            <div class="card-body">
                @if ($project->tech_stack)
                    <div>
                        <div class="text-sm font-medium text-gray-700 dark:text-zinc-300">
                            Tech Stack
                        </div>

                        <div class="mt-3 flex flex-wrap gap-2">
                            @foreach (explode(',', $project->tech_stack) as $tech)
                                <span class="tag-pill">{{ trim($tech) }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if ($project->github_url || $project->demo_url)
                    <div class="mt-6 flex flex-wrap gap-3">
                        @if ($project->github_url)
                            <a
                                href="{{ $project->github_url }}"
                                target="_blank"
                                class="secondary-btn"
                            >
                                GitHub →
                            </a>
                        @endif

                        @if ($project->demo_url)
                            <a
                                href="{{ $project->demo_url }}"
                                target="_blank"
                                class="primary-btn"
                            >
                                Live Demo →
                            </a>
                        @endif
                    </div>
                @endif

                @if ($project->content)
                    <div class="mt-8 border-t border-gray-200 pt-8 dark:border-zinc-800">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Project Overview
                        </h2>

                        <div class="mt-4 whitespace-pre-line text-sm sm:text-base leading-7 text-gray-600 dark:text-zinc-400">
                            {{ $project->content }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    @if ($project->images && $project->images->count())
        <section class="section-block reveal-up">
            <div>
                <h2 class="section-title">Gallery</h2>
                <p class="section-subtitle">Screenshots and visual previews from the project.</p>

                <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($project->images as $img)
                        <a
                            href="{{ asset('storage/' . $img->image_path) }}"
                            target="_blank"
                            class="card-panel interactive-card block overflow-hidden hover:border-gray-300 dark:hover:border-zinc-700"
                        >
                            <img
                                src="{{ asset('storage/' . $img->image_path) }}"
                                alt="{{ $project->title }} gallery image"
                                class="h-56 w-full object-cover"
                            />
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-layouts.public>