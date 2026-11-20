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

    <link rel="icon" type="image/jpeg" href="{{ asset('weblogo.jpeg') }}">

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

        [x-cloak] {
            display: none !important;
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
    class="relative min-h-screen overflow-x-hidden bg-gray-50 text-gray-900 transition-colors duration-300 dark:bg-zinc-950 dark:text-white">
    <div aria-hidden="true" class="pointer-events-none fixed inset-0 -z-10 overflow-hidden">
        <div
            class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(59,130,246,0.10),transparent_35%),radial-gradient(circle_at_top_right,rgba(168,85,247,0.10),transparent_35%),radial-gradient(circle_at_bottom,rgba(16,185,129,0.08),transparent_35%)] dark:bg-[radial-gradient(circle_at_top_left,rgba(59,130,246,0.16),transparent_35%),radial-gradient(circle_at_top_right,rgba(168,85,247,0.14),transparent_35%),radial-gradient(circle_at_bottom,rgba(16,185,129,0.10),transparent_35%)]">
        </div>

        <div
            class="absolute inset-0 bg-[linear-gradient(to_right,rgba(0,0,0,0.035)_1px,transparent_1px),linear-gradient(to_bottom,rgba(0,0,0,0.035)_1px,transparent_1px)] bg-[size:44px_44px] opacity-60 dark:bg-[linear-gradient(to_right,rgba(255,255,255,0.035)_1px,transparent_1px),linear-gradient(to_bottom,rgba(255,255,255,0.035)_1px,transparent_1px)]">
        </div>

        <div class="animated-background-wash absolute -inset-40 opacity-70"></div>
        <div class="floating-orb floating-orb-1"></div>
        <div class="floating-orb floating-orb-2"></div>
        <div class="floating-orb floating-orb-3"></div>
        <div class="floating-orb floating-orb-4"></div>
        <div class="floating-orb floating-orb-5"></div>
        <div class="floating-orb floating-orb-6"></div>
        <div class="floating-orb floating-orb-7"></div>
        <div class="floating-orb floating-orb-8"></div>
        <div class="floating-orb floating-orb-9"></div>
        <div class="floating-orb floating-orb-10"></div>
    </div>
    <header x-data="{ mobileMenuOpen: false }"
        class="border-b border-gray-200 bg-white/80 backdrop-blur transition-colors duration-300 dark:border-zinc-800 dark:bg-zinc-950/80">
        <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="shrink-0 text-lg font-semibold text-gray-900 dark:text-white">
                {{ $settings->full_name ?? ($settings->name ?? 'Abed') }}
            </a>

            @php
                $linkClass = fn($active) => $active
                    ? 'text-sm font-medium text-gray-900 underline underline-offset-4 dark:text-white'
                    : 'text-sm text-gray-600 transition hover:text-gray-900 dark:text-zinc-300 dark:hover:text-white';
            @endphp

            <nav class="hidden sm:flex sm:flex-1 items-center justify-end gap-4 lg:gap-5">
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

                <span class="mx-1 shrink-0 text-gray-300 dark:text-zinc-700">|</span>


                <button onclick="toggleTheme()"
                    class="ml-2 inline-flex shrink-0 items-center justify-center rounded-xl border border-gray-300 bg-white px-3 py-1.5 text-xs font-medium text-gray-900 transition hover:bg-gray-100 dark:border-zinc-700 dark:bg-zinc-900 dark:text-white dark:hover:bg-zinc-800">
                    Toggle
                </button>
            </nav>

            <button type="button"
                class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white p-2 text-gray-900 transition hover:bg-gray-100 sm:hidden dark:border-zinc-700 dark:bg-zinc-900 dark:text-white dark:hover:bg-zinc-800"
                @click="mobileMenuOpen = !mobileMenuOpen" :aria-expanded="mobileMenuOpen.toString()"
                aria-controls="mobile-public-nav" aria-label="Toggle navigation">
                <svg x-show="!mobileMenuOpen" x-cloak xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                <svg x-show="mobileMenuOpen" x-cloak xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <nav id="mobile-public-nav" x-cloak x-show="mobileMenuOpen" x-transition
            class="border-t border-gray-200 px-4 py-4 sm:hidden dark:border-zinc-800">
            <div class="mx-auto flex max-w-6xl flex-col gap-2">
                <a href="{{ route('home') }}" @click="mobileMenuOpen = false"
                    class="rounded-xl px-3 py-2 {{ request()->routeIs('home') ? 'bg-gray-100 text-gray-900 dark:bg-zinc-900 dark:text-white' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-zinc-300 dark:hover:bg-zinc-900 dark:hover:text-white' }}">
                    Home
                </a>

                <a href="{{ route('projects.public.index') }}" @click="mobileMenuOpen = false"
                    class="rounded-xl px-3 py-2 {{ request()->routeIs('projects.public.*') ? 'bg-gray-100 text-gray-900 dark:bg-zinc-900 dark:text-white' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-zinc-300 dark:hover:bg-zinc-900 dark:hover:text-white' }}">
                    Projects
                </a>

                <a href="{{ route('about') }}" @click="mobileMenuOpen = false"
                    class="rounded-xl px-3 py-2 {{ request()->routeIs('about') ? 'bg-gray-100 text-gray-900 dark:bg-zinc-900 dark:text-white' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-zinc-300 dark:hover:bg-zinc-900 dark:hover:text-white' }}">
                    About
                </a>

                @if ($settings->blog_enabled ?? true)
                    <a href="{{ route('blog.index') }}" @click="mobileMenuOpen = false"
                        class="rounded-xl px-3 py-2 {{ request()->routeIs('blog.*') ? 'bg-gray-100 text-gray-900 dark:bg-zinc-900 dark:text-white' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-zinc-300 dark:hover:bg-zinc-900 dark:hover:text-white' }}">
                        Blog
                    </a>
                @endif

                <a href="{{ route('contact') }}" @click="mobileMenuOpen = false"
                    class="rounded-xl px-3 py-2 {{ request()->routeIs('contact') ? 'bg-gray-100 text-gray-900 dark:bg-zinc-900 dark:text-white' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-zinc-300 dark:hover:bg-zinc-900 dark:hover:text-white' }}">
                    Contact
                </a>

                <div class="mt-2 grid grid-cols-2 gap-2">
                    <button type="button" onclick="toggleTheme()"
                        class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-3 py-2 text-sm font-medium text-gray-900 transition hover:bg-gray-100 dark:border-zinc-700 dark:bg-zinc-900 dark:text-white dark:hover:bg-zinc-800">
                        Toggle
                    </button>
                </div>
            </div>
        </nav>
    </header>

    <main class="site-container section-block">
        {{ $slot }}
    </main>

    <footer
        class="border-t border-gray-200 bg-white/70 transition-colors duration-300 dark:border-zinc-800 dark:bg-zinc-950/70">
        <div class="mx-auto max-w-6xl px-4 py-10">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <div>
                    <a href="{{ route('home') }}" class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ $settings->full_name ?? ($settings->name ?? 'Abed') }}
                    </a>

                    @if ($settings->headline)
                        <p class="mt-3 max-w-sm text-sm leading-6 text-gray-600 dark:text-zinc-400">
                            {{ $settings->headline }}
                        </p>
                    @else
                        <p class="mt-3 max-w-sm text-sm leading-6 text-gray-600 dark:text-zinc-400">
                            Software developer portfolio built to showcase projects, experience, and contact
                            information.
                        </p>
                    @endif
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                        Quick Links
                    </h3>

                    <div class="mt-4 flex flex-col gap-2 text-sm">
                        <a href="{{ route('home') }}"
                            class="text-gray-600 transition hover:text-gray-900 dark:text-zinc-400 dark:hover:text-white">
                            Home
                        </a>

                        <a href="{{ route('projects.public.index') }}"
                            class="text-gray-600 transition hover:text-gray-900 dark:text-zinc-400 dark:hover:text-white">
                            Projects
                        </a>

                        <a href="{{ route('about') }}"
                            class="text-gray-600 transition hover:text-gray-900 dark:text-zinc-400 dark:hover:text-white">
                            About
                        </a>

                        @if ($settings->blog_enabled ?? true)
                            <a href="{{ route('blog.index') }}"
                                class="text-gray-600 transition hover:text-gray-900 dark:text-zinc-400 dark:hover:text-white">
                                Blog
                            </a>
                        @endif

                        <a href="{{ route('contact') }}"
                            class="text-gray-600 transition hover:text-gray-900 dark:text-zinc-400 dark:hover:text-white">
                            Contact
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                        Connect
                    </h3>

                    <div class="mt-4 flex flex-col gap-2 text-sm">
                        @if ($settings->email)
                            <a href="mailto:{{ $settings->email }}"
                                class="break-all text-gray-600 transition hover:text-gray-900 dark:text-zinc-400 dark:hover:text-white">
                                {{ $settings->email }}
                            </a>
                        @endif

                        @if ($settings->github_url)
                            <a href="{{ $settings->github_url }}" target="_blank" rel="noopener noreferrer"
                                class="break-all text-gray-600 transition hover:text-gray-900 dark:text-zinc-400 dark:hover:text-white">
                                GitHub
                            </a>
                        @endif

                        @if ($settings->linkedin_url)
                            <a href="{{ $settings->linkedin_url }}" target="_blank" rel="noopener noreferrer"
                                class="break-all text-gray-600 transition hover:text-gray-900 dark:text-zinc-400 dark:hover:text-white">
                                LinkedIn
                            </a>
                        @endif

                        @if (!$settings->email && !$settings->github_url && !$settings->linkedin_url)
                            <p class="text-gray-600 dark:text-zinc-400">
                                Add contact links from Admin → Site Settings.
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <div
                class="mt-8 flex flex-col gap-3 border-t border-gray-200 pt-6 text-sm text-gray-500 dark:border-zinc-800 dark:text-zinc-500 sm:flex-row sm:items-center sm:justify-between">
                <p>
                    © {{ date('Y') }} {{ $settings->full_name ?? ($settings->name ?? 'Abed') }}. All rights
                    reserved.
                </p>

                <p>
                    Built with Laravel, Blade, and Tailwind CSS.
                </p>
            </div>
        </div>
    </footer>
</body>

</html>
