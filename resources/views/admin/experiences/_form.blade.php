@php
    $isEdit = isset($exp);
@endphp

<div class="space-y-6">
    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <label for="company" class="mb-2 block text-sm font-medium text-zinc-800 dark:text-zinc-100">
                Company <span class="text-red-500">*</span>
            </label>
            <input id="company" name="company" type="text" value="{{ old('company', $exp->company ?? '') }}"
                placeholder="Example: Poseidon Dive Center"
                class="w-full rounded-xl border border-zinc-300 bg-white px-4 py-2.5 text-sm text-zinc-900 outline-none transition placeholder:text-zinc-400 focus:border-zinc-500 focus:ring-2 focus:ring-zinc-200 dark:border-zinc-700 dark:bg-zinc-950 dark:text-white dark:placeholder:text-zinc-500 dark:focus:border-zinc-500 dark:focus:ring-zinc-800">
            @error('company')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="role" class="mb-2 block text-sm font-medium text-zinc-800 dark:text-zinc-100">
                Role <span class="text-red-500">*</span>
            </label>
            <input id="role" name="role" type="text" value="{{ old('role', $exp->role ?? '') }}"
                placeholder="Example: Software Engineer Intern"
                class="w-full rounded-xl border border-zinc-300 bg-white px-4 py-2.5 text-sm text-zinc-900 outline-none transition placeholder:text-zinc-400 focus:border-zinc-500 focus:ring-2 focus:ring-zinc-200 dark:border-zinc-700 dark:bg-zinc-950 dark:text-white dark:placeholder:text-zinc-500 dark:focus:border-zinc-500 dark:focus:ring-zinc-800">
            @error('role')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <label for="start_date" class="mb-2 block text-sm font-medium text-zinc-800 dark:text-zinc-100">
                Start Date
            </label>
            <input id="start_date" name="start_date" type="date"
                value="{{ old('start_date', $exp->start_date ?? '') }}"
                class="w-full rounded-xl border border-zinc-300 bg-white px-4 py-2.5 text-sm text-zinc-900 outline-none transition focus:border-zinc-500 focus:ring-2 focus:ring-zinc-200 dark:border-zinc-700 dark:bg-zinc-950 dark:text-white dark:focus:border-zinc-500 dark:focus:ring-zinc-800">
            @error('start_date')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="end_date" class="mb-2 block text-sm font-medium text-zinc-800 dark:text-zinc-100">
                End Date
            </label>
            <input id="end_date" name="end_date" type="date" value="{{ old('end_date', $exp->end_date ?? '') }}"
                class="w-full rounded-xl border border-zinc-300 bg-white px-4 py-2.5 text-sm text-zinc-900 outline-none transition focus:border-zinc-500 focus:ring-2 focus:ring-zinc-200 dark:border-zinc-700 dark:bg-zinc-950 dark:text-white dark:focus:border-zinc-500 dark:focus:ring-zinc-800">
            <p class="mt-2 text-xs text-zinc-500 dark:text-zinc-400">
                Leave this empty if the role is still ongoing.
            </p>
            @error('end_date')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label for="description" class="mb-2 block text-sm font-medium text-zinc-800 dark:text-zinc-100">
            Description
        </label>
        <textarea id="description" name="description" rows="6"
            placeholder="Write a short summary of your work, responsibilities, or achievements."
            class="w-full rounded-xl border border-zinc-300 bg-white px-4 py-3 text-sm text-zinc-900 outline-none transition placeholder:text-zinc-400 focus:border-zinc-500 focus:ring-2 focus:ring-zinc-200 dark:border-zinc-700 dark:bg-zinc-950 dark:text-white dark:placeholder:text-zinc-500 dark:focus:border-zinc-500 dark:focus:ring-zinc-800">{{ old('description', $exp->description ?? '') }}</textarea>
        @error('description')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <label for="sort_order" class="mb-2 block text-sm font-medium text-zinc-800 dark:text-zinc-100">
                Sort Order
            </label>
            <input id="sort_order" name="sort_order" type="number" min="0"
                value="{{ old('sort_order', $exp->sort_order ?? 0) }}"
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
                        {{ old('is_visible', $exp->is_visible ?? true) ? 'checked' : '' }}
                        class="mt-1 h-4 w-4 rounded border-zinc-300 text-zinc-900 focus:ring-zinc-400 dark:border-zinc-600 dark:bg-zinc-900 dark:text-white dark:focus:ring-zinc-700">
                    <div>
                        <span class="block text-sm font-medium text-zinc-800 dark:text-zinc-100">Visible</span>
                        <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">
                            Show this experience on the public website.
                        </p>
                    </div>
                </label>
            </div>
        </div>
    </div>
</div>
