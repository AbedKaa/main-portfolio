<!DOCTYPE html>
<html lang="en" class="h-full scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @php
        $desc = isset($settings) && $settings->meta_description ? $settings->meta_description : 'Portfolio website';
    @endphp

    <title>
        {{ $title ?? 'Portfolio' }}{{ isset($settings) && $settings->site_title ? ' | ' . $settings->site_title : '' }}
    </title>

    <meta name="description" content="{{ $desc }}">
    <meta property="og:title" content="{{ $title ?? 'Portfolio' }}">
    <meta property="og:description" content="{{ $desc }}">
    <meta property="og:type" content="website">

    @if (isset($settings) && $settings?->og_image)
        <meta property="og:image" content="{{ asset('storage/' . $settings->og_image) }}">
    @endif

    <link rel="icon" href="/favicon.ico">

    <script>
        (function() {
            const root = document.documentElement;
            root.classList.add('theme-preload');

            const storageKey = 'public-theme';
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

<body data-theme-scope="public"
    class="min-h-screen bg-gray-50 text-gray-900 transition-colors duration-300 dark:bg-zinc-950 dark:text-white">
    <header
        class="border-b border-gray-200 bg-white/80 backdrop-blur transition-colors duration-300 dark:border-zinc-800 dark:bg-zinc-950/80">
        <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="text-lg font-semibold text-gray-900 dark:text-white">
                {{ $settings->full_name ?? ($settings->name ?? 'Abed') }}
            </a>

            @php
                $linkClass = fn($active) => $active
                    ? 'text-sm font-medium text-gray-900 underline underline-offset-4 dark:text-white'
                    : 'text-sm text-gray-600 transition hover:text-gray-900 dark:text-zinc-300 dark:hover:text-white';
            @endphp

            <nav class="flex flex-wrap items-center gap-4">
                <a href="{{ route('home') }}" class="{{ $linkClass(request()->routeIs('home')) }}">Home</a>

                <a href="{{ route('projects.public.index') }}"
                    class="{{ $linkClass(request()->routeIs('projects.public.*')) }}">
                    Projects
                </a>

                <a href="{{ route('about') }}" class="{{ $linkClass(request()->routeIs('about')) }}">About</a>

                @if ($settings->blog_enabled ?? true)
                    <a href="{{ route('blog.index') }}" class="{{ $linkClass(request()->routeIs('blog.*')) }}">
                        Blog
                    </a>
                @endif

                <a href="{{ route('contact') }}" class="{{ $linkClass(request()->routeIs('contact')) }}">Contact</a>

                <span class="mx-1 text-gray-300 dark:text-zinc-700">|</span>

                <a href="{{ route('login') }}" class="{{ $linkClass(false) }}">Admin</a>

                <button onclick="toggleTheme()"
                    class="ml-2 inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-3 py-1.5 text-xs font-medium text-gray-900 transition hover:bg-gray-100 dark:border-zinc-700 dark:bg-zinc-900 dark:text-white dark:hover:bg-zinc-800">
                    Toggle
                </button>
            </nav>
        </div>
    </header>

    <main class="site-container section-block">
        {{ $slot }}
    </main>

    <footer
        class="border-t border-gray-200 bg-white/70 transition-colors duration-300 dark:border-zinc-800 dark:bg-zinc-950/70">
        <div class="max-w-6xl mx-auto px-4 py-6 text-sm text-gray-600 dark:text-zinc-400">
            © {{ date('Y') }} {{ $settings->full_name ?? ($settings->name ?? 'Abed') }}
        </div>
    </footer>
</body>

</html>
