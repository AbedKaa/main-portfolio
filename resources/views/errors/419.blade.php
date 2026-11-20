<x-layouts.public title="Page Expired">
    <section class="section-block reveal-up">
        <div class="mx-auto max-w-3xl text-center">
            <div
                class="interactive-card rounded-3xl border border-gray-200 bg-white/80 p-8 shadow-sm backdrop-blur dark:border-gray-800 dark:bg-gray-900/80 sm:p-12">

                <div
                    class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-2xl border border-purple-200 bg-purple-50 text-2xl font-bold text-purple-700 dark:border-purple-900/40 dark:bg-purple-950/30 dark:text-purple-300">
                    419
                </div>

                <p class="mb-3 text-sm font-semibold uppercase tracking-[0.3em] text-gray-500 dark:text-gray-400">
                    Page expired
                </p>

                <h1 class="text-3xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-4xl">
                    Your session has expired.
                </h1>

                <p class="mx-auto mt-4 max-w-xl text-base leading-7 text-gray-600 dark:text-gray-400">
                    This usually happens when a form was left open for too long. Please go back, refresh the page, and
                    try again.
                </p>

                <div class="mt-8 flex flex-col justify-center gap-3 sm:flex-row">
                    <button type="button" onclick="history.back()"
                        class="inline-flex items-center justify-center rounded-xl bg-gray-900 px-5 py-3 text-sm font-medium text-white transition hover:bg-black dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200">
                        Go Back
                    </button>

                    <a href="{{ route('home') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-5 py-3 text-sm font-medium text-gray-700 transition hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-layouts.public>
