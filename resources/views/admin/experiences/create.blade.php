<x-layouts.admin title="Add Experience">
    <x-admin.page-header title="Add Experience"
        description="Add a new work, internship, or professional experience to your portfolio." />

    <div class="max-w-4xl">
        <form method="POST" action="{{ route('experiences.store') }}" class="space-y-6">
            @csrf

            <div class="rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                @include('admin.experiences._form')
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                <button type="submit"
                    class="inline-flex items-center justify-center rounded-xl bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-zinc-800 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200">
                    Save Experience
                </button>

                <a href="{{ route('experiences.index') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-zinc-200 bg-white px-4 py-2.5 text-sm font-medium text-zinc-700 transition hover:bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-200 dark:hover:bg-zinc-800">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-layouts.admin>
