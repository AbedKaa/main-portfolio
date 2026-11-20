<x-layouts.public title="Temporarily Unavailable">
    <section class="section-block reveal-up">
        <div class="mx-auto max-w-3xl text-center">
            <div
                class="interactive-card rounded-3xl border border-gray-200 bg-white/80 p-8 shadow-sm backdrop-blur dark:border-gray-800 dark:bg-gray-900/80 sm:p-12">

                <div
                    class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-2xl border border-blue-200 bg-blue-50 text-2xl font-bold text-blue-700 dark:border-blue-900/40 dark:bg-blue-950/30 dark:text-blue-300">
                    503
                </div>

                <p class="mb-3 text-sm font-semibold uppercase tracking-[0.3em] text-gray-500 dark:text-gray-400">
                    Temporarily unavailable
                </p>

                <h1 class="text-3xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-4xl">
                    The site is taking a short break.
                </h1>

                <p class="mx-auto mt-4 max-w-xl text-base leading-7 text-gray-600 dark:text-gray-400">
                    I may be updating the website or making small improvements. Please check again soon.
                </p>

                <div class="mt-8 flex flex-col justify-center gap-3 sm:flex-row">
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center justify-center rounded-xl bg-gray-900 px-5 py-3 text-sm font-medium text-white transition hover:bg-black dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200">
                        Try Home
                    </a>

                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-5 py-3 text-sm font-medium text-gray-700 transition hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                        Contact Me
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-layouts.public>
