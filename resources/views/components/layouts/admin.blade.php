<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Admin' }}</title>

    <script>
        (function() {
            const root = document.documentElement;
            root.classList.add('theme-preload');

            const storageKey = 'admin-theme';
            const savedTheme = localStorage.getItem(storageKey);
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const isDark = savedTheme ? savedTheme === 'dark' : prefersDark;

            if (isDark) {
                root.classList.add('dark');
                root.style.colorScheme = 'dark';
            } else {
                root.classList.remove('dark');
                root.style.colorScheme = 'light';
            }
        })();
    </script>

    <style>
        html.theme-preload *,
        html.theme-preload *::before,
        html.theme-preload *::after {
            transition: none !important;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        window.addEventListener('DOMContentLoaded', function() {
            document.documentElement.classList.remove('theme-preload');
        });
    </script>
</head>

<body data-theme-scope="admin" class="h-full bg-gray-100 text-gray-900 dark:bg-gray-950 dark:text-gray-100">
    <div class="min-h-screen flex">
        <aside class="w-64 border-r border-gray-200 bg-white/95 backdrop-blur dark:border-gray-800 dark:bg-gray-900/95">
            <div class="border-b border-gray-200 px-5 py-5 dark:border-gray-800">
                <a href="{{ route('admin.dashboard') }}" class="text-lg font-bold text-gray-900 dark:text-white">
                    Admin Panel
                </a>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    {{ auth()->user()->name }}
                </p>
            </div>

            @php
                $adminLinkClass = fn($active) => $active
                    ? 'block px-3 py-2 rounded-lg bg-gray-100 text-gray-900 font-medium dark:bg-gray-800 dark:text-white'
                    : 'block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800';
            @endphp

            <nav class="p-4 text-sm space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="{{ $adminLinkClass(request()->routeIs('admin.dashboard')) }}">
                    Dashboard
                </a>

                <a href="{{ route('projects.index') }}" class="{{ $adminLinkClass(request()->routeIs('projects.*')) }}">
                    Projects
                </a>

                <a href="{{ route('posts.index') }}" class="{{ $adminLinkClass(request()->routeIs('posts.*')) }}">
                    Blog Posts
                </a>

                <a href="{{ route('skills.index') }}" class="{{ $adminLinkClass(request()->routeIs('skills.*')) }}">
                    Skills
                </a>

                <a href="{{ route('experiences.index') }}"
                    class="{{ $adminLinkClass(request()->routeIs('experiences.*')) }}">
                    Experience
                </a>

                <a href="{{ route('certificates.index') }}"
                    class="{{ $adminLinkClass(request()->routeIs('certificates.*')) }}">
                    Certificates
                </a>

                <a href="{{ route('admin.settings.edit') }}"
                    class="{{ $adminLinkClass(request()->routeIs('admin.settings.*')) }}">
                    Site Settings
                </a>

                <a href="{{ route('messages.index') }}"
                    class="{{ $adminLinkClass(request()->routeIs('messages.*')) }}">
                    Messages
                </a>

                <div class="mt-4 border-t border-gray-200 pt-4 dark:border-gray-800">
                    <a href="/"
                        class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">
                        View Website →
                    </a>
                </div>
            </nav>
        </aside>

        <main class="flex-1">
            <header class="border-b border-gray-200 bg-white/80 backdrop-blur dark:border-gray-800 dark:bg-gray-900/80">
                <div class="px-6 py-4 flex items-center justify-between gap-4">
                    <div>
                        <h1 class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $title ?? 'Admin' }}
                        </h1>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Manage your portfolio content from the dashboard.
                        </p>
                    </div>

                    <div class="flex items-center gap-3">
                        <button onclick="toggleTheme()"
                            class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-xs font-medium text-gray-900 transition hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700">
                            Toggle
                        </button>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button
                                class="inline-flex items-center justify-center rounded-lg border border-red-200 px-3 py-1.5 text-sm font-medium text-red-600 transition hover:bg-red-50 dark:border-red-900/40 dark:text-red-400 dark:hover:bg-red-950/30"
                                type="submit">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <div class="p-6">
                <div
                    class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-gray-900">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>
</body>

</html>
