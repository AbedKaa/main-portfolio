<x-layouts.public title="About">
    <section class="section-block reveal-up">
        <div class="max-w-3xl">
            <h1 class="section-title">About Me</h1>
            <p class="section-subtitle">A quick introduction, background, and what I focus on.</p>

            <div class="card-panel interactive-card mt-6">
                <div class="card-body">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{ $settings->full_name ?? 'Your Name' }}
                    </h2>

                    @if ($settings->headline)
                        <p class="mt-2 text-sm sm:text-base font-medium text-gray-700 dark:text-zinc-300">
                            {{ $settings->headline }}
                        </p>
                    @endif

                    @if ($settings->bio)
                        <p
                            class="mt-4 text-sm sm:text-base leading-7 text-gray-600 dark:text-zinc-400 whitespace-pre-line">
                            {{ $settings->bio }}
                        </p>
                    @else
                        <p class="mt-4 text-sm sm:text-base leading-7 text-gray-600 dark:text-zinc-400">
                            No bio yet. Add it from Admin → Site Settings.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="section-block reveal-up">
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <h2 class="section-title">Experience</h2>
                <p class="section-subtitle">A summary of my work, roles, and responsibilities.</p>

                @if ($experiences->count() === 0)
                    <p class="mt-6 text-sm text-gray-600 dark:text-zinc-400">
                        No experience yet. Add it from Admin → Experience.
                    </p>
                @else
                    <div class="mt-6 space-y-4">
                        @foreach ($experiences as $exp)
                            <div class="card-panel interactive-card">
                                <div class="card-body">
                                    <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
                                        <div>
                                            <div class="text-lg font-semibold text-gray-900 dark:text-white">
                                                {{ $exp->role }}
                                            </div>
                                            <div class="text-sm text-gray-600 dark:text-zinc-400">
                                                {{ $exp->company }}
                                            </div>
                                        </div>

                                        <div class="text-sm text-gray-500 dark:text-zinc-500">
                                            @php
                                                $start = $exp->start_date
                                                    ? \Carbon\Carbon::parse($exp->start_date)->format('M Y')
                                                    : null;

                                                $end = $exp->end_date
                                                    ? \Carbon\Carbon::parse($exp->end_date)->format('M Y')
                                                    : 'Present';
                                            @endphp

                                            {{ $start ? $start . ' — ' : '' }}{{ $end }}
                                        </div>
                                    </div>

                                    @if ($exp->description)
                                        <p
                                            class="mt-4 text-sm sm:text-base leading-7 text-gray-600 dark:text-zinc-400 whitespace-pre-line">
                                            {{ $exp->description }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div>
                <h2 class="section-title">Skills</h2>
                <p class="section-subtitle">Technologies and tools I work with.</p>

                <div class="card-panel interactive-card mt-6">
                    <div class="card-body">
                        @if ($skills->count() === 0)
                            <p class="text-sm text-gray-600 dark:text-zinc-400">
                                No skills yet. Add them from Admin → Skills.
                            </p>
                        @else
                            <div class="space-y-5">
                                @foreach ($skills as $category => $items)
                                    <div>
                                        <div class="text-sm font-medium text-gray-700 dark:text-zinc-300">
                                            {{ $category }}
                                        </div>

                                        <div class="mt-3 flex flex-wrap gap-2">
                                            @foreach ($items as $skill)
                                                <span class="tag-pill">{{ $skill->name }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-block reveal-up">
        <div>
            <h2 class="section-title">Certificates</h2>
            <p class="section-subtitle">Certifications, achievements, and credentials.</p>

            @if ($certificates->count() === 0)
                <p class="mt-6 text-sm text-gray-600 dark:text-zinc-400">
                    No certificates yet. Add them from Admin → Certificates.
                </p>
            @else
                <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-2">
                    @foreach ($certificates as $c)
                        <div class="card-panel interactive-card">
                            <div class="card-body">
                                <div class="font-semibold text-gray-900 dark:text-white">
                                    {{ $c->title }}
                                </div>

                                <div class="mt-2 text-sm text-gray-600 dark:text-zinc-400">
                                    @if ($c->issuer)
                                        {{ $c->issuer }}
                                    @endif

                                    @if ($c->issuer && $c->issue_date)
                                        •
                                    @endif

                                    @if ($c->issue_date)
                                        {{ \Carbon\Carbon::parse($c->issue_date)->format('M Y') }}
                                    @endif
                                </div>

                                @if ($c->slug)
                                    <a class="mt-4 inline-flex items-center text-sm font-medium text-gray-700 transition hover:text-black dark:text-zinc-300 dark:hover:text-white"
                                        href="{{ route('certificates.public.show', $c->slug) }}">
                                        View Credential →
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</x-layouts.public>
