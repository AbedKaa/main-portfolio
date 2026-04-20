<x-layouts.public title="Projects">
    <section class="section-block reveal-up">
        <div class="max-w-3xl">
            <h1 class="section-title">Projects</h1>
            <p class="section-subtitle">
                A selection of work, case studies, and builds from my portfolio.
            </p>
        </div>

        <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-2">
            @forelse ($projects as $project)
                <a href="{{ route('projects.public.show', $project->slug) }}"
                    class="card-panel interactive-card flex h-full flex-col overflow-hidden hover:border-gray-300 dark:hover:border-zinc-700">
                    @if ($project->cover_image)
                        <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->title }}"
                            class="h-48 w-full object-cover" />
                    @endif

                    <div class="card-body flex flex-1 flex-col">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                            {{ $project->title }}
                        </h2>

                        @if ($project->short_description)
                            <p class="mt-3 text-sm leading-7 text-gray-600 dark:text-zinc-400 sm:text-base">
                                {{ $project->short_description }}
                            </p>
                        @else
                            <p class="mt-3 text-sm leading-7 text-gray-500 dark:text-zinc-500 sm:text-base">
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
                <div class="md:col-span-2">
                    <p
                        class="rounded-2xl border border-dashed border-gray-300 px-6 py-10 text-center text-gray-600 dark:border-zinc-700 dark:text-zinc-400">
                        No projects yet.
                    </p>
                </div>
            @endforelse
        </div>

        @if ($projects->hasPages())
            <div class="mt-10 flex justify-center">
                <nav
                    class="inline-flex items-center gap-2 rounded-2xl border border-gray-200 bg-white/70 p-2 shadow-sm backdrop-blur dark:border-zinc-800 dark:bg-zinc-900/70">
                    @if ($projects->onFirstPage())
                        <span
                            class="inline-flex h-10 items-center justify-center rounded-xl px-4 text-sm font-medium text-gray-400 dark:text-zinc-600">
                            ←
                        </span>
                    @else
                        <a href="{{ $projects->previousPageUrl() }}"
                            class="inline-flex h-10 items-center justify-center rounded-xl px-4 text-sm font-medium text-gray-600 transition hover:bg-gray-100 hover:text-gray-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-white">
                            ←
                        </a>
                    @endif

                    @foreach ($projects->getUrlRange(1, $projects->lastPage()) as $page => $url)
                        @if ($page == $projects->currentPage())
                            <span
                                class="inline-flex h-10 min-w-10 items-center justify-center rounded-xl bg-gray-900 px-3 text-sm font-semibold text-white dark:bg-white dark:text-zinc-900">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                                class="inline-flex h-10 min-w-10 items-center justify-center rounded-xl px-3 text-sm font-medium text-gray-600 transition hover:bg-gray-100 hover:text-gray-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-white">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach

                    @if ($projects->hasMorePages())
                        <a href="{{ $projects->nextPageUrl() }}"
                            class="inline-flex h-10 items-center justify-center rounded-xl px-4 text-sm font-medium text-gray-600 transition hover:bg-gray-100 hover:text-gray-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-white">
                            →
                        </a>
                    @else
                        <span
                            class="inline-flex h-10 items-center justify-center rounded-xl px-4 text-sm font-medium text-gray-400 dark:text-zinc-600">
                            →
                        </span>
                    @endif
                </nav>
            </div>
        @endif
    </section>
</x-layouts.public>
