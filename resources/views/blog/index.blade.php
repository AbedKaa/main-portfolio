<x-layouts.public title="Blog">
    <section class="section-block reveal-up">
        <div class="max-w-3xl">
            <h1 class="section-title">Blog</h1>
            <p class="section-subtitle">
                Notes, thoughts, and write-ups from my work and learning journey.
            </p>
        </div>

        <div class="mt-8 space-y-5">
            @forelse($posts as $post)
                <a
                    href="{{ route('blog.show', $post->slug) }}"
                    class="card-panel interactive-card block hover:border-gray-300 dark:hover:border-zinc-700"
                >
                    <div class="card-body">
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                            <div class="flex-1">
                                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    {{ $post->title }}
                                </h2>

                                @if ($post->excerpt)
                                    <p class="mt-3 text-sm sm:text-base leading-7 text-gray-600 dark:text-zinc-400">
                                        {{ $post->excerpt }}
                                    </p>
                                @endif
                            </div>

                            <div class="shrink-0 text-sm text-gray-500 dark:text-zinc-500">
                                {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('M d, Y') : 'Draft' }}
                            </div>
                        </div>

                        <div class="mt-5 flex items-center justify-between">
                            <span class="tag-pill">Article</span>

                            <span class="text-sm font-medium text-gray-700 dark:text-zinc-300">
                                Read more →
                            </span>
                        </div>
                    </div>
                </a>
            @empty
                <p class="text-gray-600 dark:text-zinc-400">No posts yet.</p>
            @endforelse
        </div>
    </section>
</x-layouts.public>