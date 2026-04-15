<x-layouts.admin title="Add Certificate">
    <x-admin.page-header title="Add Certificate"
        description="Add a certificate, course completion, or professional achievement to your portfolio." />

    <div class="max-w-4xl">
        <form method="POST" action="{{ route('certificates.store') }}" class="space-y-6">
            @csrf

            <div class="rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                @include('admin.certificates._form')
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                <button type="submit"
                    class="inline-flex items-center justify-center rounded-xl bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-zinc-800 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200">
                    Save Certificate
                </button>

                <a href="{{ route('certificates.index') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-zinc-200 bg-white px-4 py-2.5 text-sm font-medium text-zinc-700 transition hover:bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-200 dark:hover:bg-zinc-800">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-layouts.admin>
