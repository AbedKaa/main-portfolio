@php
    $isEdit = isset($c);
@endphp

<div class="space-y-6">
    <div>
        <label for="title" class="mb-2 block text-sm font-medium text-zinc-800 dark:text-zinc-100">
            Title <span class="text-red-500">*</span>
        </label>
        <input id="title" name="title" type="text" value="{{ old('title', $c->title ?? '') }}"
            placeholder="Example: AWS Cloud Practitioner"
            class="w-full rounded-xl border border-zinc-300 bg-white px-4 py-2.5 text-sm text-zinc-900 outline-none transition placeholder:text-zinc-400 focus:border-zinc-500 focus:ring-2 focus:ring-zinc-200 dark:border-zinc-700 dark:bg-zinc-950 dark:text-white dark:placeholder:text-zinc-500 dark:focus:border-zinc-500 dark:focus:ring-zinc-800">
        @error('title')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <label for="issuer" class="mb-2 block text-sm font-medium text-zinc-800 dark:text-zinc-100">
                Issuer
            </label>
            <input id="issuer" name="issuer" type="text" value="{{ old('issuer', $c->issuer ?? '') }}"
                placeholder="Example: Coursera"
                class="w-full rounded-xl border border-zinc-300 bg-white px-4 py-2.5 text-sm text-zinc-900 outline-none transition placeholder:text-zinc-400 focus:border-zinc-500 focus:ring-2 focus:ring-zinc-200 dark:border-zinc-700 dark:bg-zinc-950 dark:text-white dark:placeholder:text-zinc-500 dark:focus:border-zinc-500 dark:focus:ring-zinc-800">
            @error('issuer')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="issue_date" class="mb-2 block text-sm font-medium text-zinc-800 dark:text-zinc-100">
                Issue Date
            </label>
            <input id="issue_date" name="issue_date" type="date"
                value="{{ old('issue_date', $c->issue_date ?? '') }}"
                class="w-full rounded-xl border border-zinc-300 bg-white px-4 py-2.5 text-sm text-zinc-900 outline-none transition focus:border-zinc-500 focus:ring-2 focus:ring-zinc-200 dark:border-zinc-700 dark:bg-zinc-950 dark:text-white dark:focus:border-zinc-500 dark:focus:ring-zinc-800">
            @error('issue_date')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label for="credential_url" class="mb-2 block text-sm font-medium text-zinc-800 dark:text-zinc-100">
            Credential URL
        </label>
        <input id="credential_url" name="credential_url" type="url"
            value="{{ old('credential_url', $c->credential_url ?? '') }}" placeholder="https://example.com/certificate"
            class="w-full rounded-xl border border-zinc-300 bg-white px-4 py-2.5 text-sm text-zinc-900 outline-none transition placeholder:text-zinc-400 focus:border-zinc-500 focus:ring-2 focus:ring-zinc-200 dark:border-zinc-700 dark:bg-zinc-950 dark:text-white dark:placeholder:text-zinc-500 dark:focus:border-zinc-500 dark:focus:ring-zinc-800">
        @error('credential_url')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <label for="sort_order" class="mb-2 block text-sm font-medium text-zinc-800 dark:text-zinc-100">
                Sort Order
            </label>
            <input id="sort_order" name="sort_order" type="number" min="0"
                value="{{ old('sort_order', $c->sort_order ?? 0) }}"
                class="w-full rounded-xl border border-zinc-300 bg-white px-4 py-2.5 text-sm text-zinc-900 outline-none transition focus:border-zinc-500 focus:ring-2 focus:ring-zinc-200 dark:border-zinc-700 dark:bg-zinc-950 dark:text-white dark:focus:border-zinc-500 dark:focus:ring-zinc-800">
            @error('sort_order')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-end">
            <div
                class="w-full rounded-2xl border border-zinc-200 bg-zinc-50 p-4 dark:border-zinc-800 dark:bg-zinc-950/50">
                <label for="is_visible" class="flex cursor-pointer items-start gap-3">
                    <input id="is_visible" type="checkbox" name="is_visible" value="1"
                        {{ old('is_visible', $c->is_visible ?? true) ? 'checked' : '' }}
                        class="mt-1 h-4 w-4 rounded border-zinc-300 text-zinc-900 focus:ring-zinc-400 dark:border-zinc-600 dark:bg-zinc-900 dark:text-white dark:focus:ring-zinc-700">
                    <div>
                        <span class="block text-sm font-medium text-zinc-800 dark:text-zinc-100">Visible</span>
                        <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">
                            Show this certificate on the public website.
                        </p>
                    </div>
                </label>
            </div>
        </div>
    </div>
</div>
