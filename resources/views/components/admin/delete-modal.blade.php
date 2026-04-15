@props([
    'action', // form action URL
    'title' => 'Delete item?',
    'message' => 'This action cannot be undone.',
    'buttonText' => 'Delete',
])

<div x-data="{ open: false }" class="inline">
    <!-- Trigger -->
    <button type="button" @click="open = true" class="text-red-600 hover:underline text-sm">
        Delete
    </button>

    <!-- Modal backdrop -->
    <div x-show="open" x-transition.opacity class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4"
        style="display:none;">
        <!-- Modal -->
        <div @click.away="open = false" x-transition
            class="w-full max-w-md rounded-xl bg-white dark:bg-gray-900 border dark:border-gray-800 p-6">
            <h3 class="text-lg font-semibold">{{ $title }}</h3>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                {{ $message }}
            </p>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" @click="open = false"
                    class="px-4 py-2 rounded border text-sm hover:bg-gray-100 dark:hover:bg-gray-800 dark:border-gray-700">
                    Cancel
                </button>

                <form method="POST" action="{{ $action }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 rounded bg-red-600 text-white text-sm">
                        {{ $buttonText }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
