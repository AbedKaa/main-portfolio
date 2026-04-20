<x-layouts.public title="{{ $certificate->title }}">
    <section class="section-block reveal-up">
        <div class="max-w-4xl">
            <a href="{{ route('about') }}"
                class="mb-6 inline-flex text-sm font-medium text-gray-600 transition hover:text-gray-900 dark:text-zinc-400 dark:hover:text-white">
                ← Back to About
            </a>

            <div class="card-panel overflow-hidden">
                <div class="card-body">
                    <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                        <div>
                            <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $certificate->title }}
                            </h1>

                            <div class="mt-3 text-sm text-gray-600 dark:text-zinc-400">
                                @if ($certificate->issuer)
                                    <span>{{ $certificate->issuer }}</span>
                                @endif

                                @if ($certificate->issuer && $certificate->issue_date)
                                    <span class="mx-2">•</span>
                                @endif

                                @if ($certificate->issue_date)
                                    <span>{{ \Carbon\Carbon::parse($certificate->issue_date)->format('M Y') }}</span>
                                @endif
                            </div>
                        </div>

                        @if ($certificate->credential_url)
                            <a href="{{ $certificate->credential_url }}" target="_blank" rel="noopener noreferrer"
                                class="primary-btn w-fit">
                                Open Original Credential →
                            </a>
                        @endif
                    </div>

                    <div class="mt-8">
                        @if ($certificate->certificate_image)
                            <img src="{{ asset('storage/' . $certificate->certificate_image) }}"
                                alt="{{ $certificate->title }}"
                                class="w-full rounded-2xl border border-gray-200 object-contain dark:border-zinc-800">
                        @else
                            <div
                                class="rounded-2xl border border-dashed border-gray-300 px-6 py-16 text-center dark:border-zinc-700">
                                <p class="text-sm text-gray-600 dark:text-zinc-400">
                                    No certificate image uploaded yet.
                                </p>
                            </div>
                        @endif
                    </div>

                    @if ($certificate->credential_url)
                        <div
                            class="mt-8 rounded-2xl border border-gray-200 bg-gray-50 p-5 dark:border-zinc-800 dark:bg-zinc-950/50">
                            <h2 class="text-sm font-semibold text-gray-900 dark:text-white">
                                Credential Link
                            </h2>

                            <p class="mt-2 break-all text-sm text-gray-600 dark:text-zinc-400">
                                {{ $certificate->credential_url }}
                            </p>

                            <a href="{{ $certificate->credential_url }}" target="_blank" rel="noopener noreferrer"
                                class="mt-4 inline-flex text-sm font-medium text-gray-700 transition hover:text-black dark:text-zinc-300 dark:hover:text-white">
                                Visit credential page →
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</x-layouts.public>
