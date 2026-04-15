<x-layouts.public :title="$post->title">
    <section class="section-block reveal-up">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="section-title">{{ $post->title }}</h1>

                <p class="section-subtitle mt-3">
                    {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('M d, Y') : 'Draft' }}
                </p>
            </div>

            <a href="{{ route('blog.index') }}" class="secondary-btn">
                ← Back to Blog
            </a>
        </div>

        <div class="mt-8 card-panel interactive-card">
            <div class="card-body">
                @if ($post->content)
                    <div class="whitespace-pre-line text-sm sm:text-base leading-8 text-gray-600 dark:text-zinc-400">
                        {{ $post->content }}
                    </div>
                @else
                    <p class="text-sm sm:text-base text-gray-600 dark:text-zinc-400">
                        No content available for this post.
                    </p>
                @endif
            </div>
        </div>
    </section>
</x-layouts.public>