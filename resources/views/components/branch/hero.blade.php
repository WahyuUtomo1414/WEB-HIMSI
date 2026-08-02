@props(['title', 'subtitle', 'backLink' => null, 'badge' => null, 'location' => null])

<section class="bg-gradient-to-b from-[#f0f4ff] to-[#f9f9fc] py-16 border-b border-[#c5c5d4]/40">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 {{ $backLink ? 'space-y-4' : 'text-center space-y-4' }}">
        @if ($backLink)
            <div class="flex items-center gap-2">
                <a href="{{ $backLink }}" class="text-xs font-semibold text-[#0453cd] hover:underline">&larr; Kembali ke Daftar Cabang</a>
            </div>
        @endif

        @if ($badge)
            <span class="inline-flex items-center gap-1.5 rounded-full bg-white px-3.5 py-1 text-xs font-semibold text-[#0453cd] border border-[#356ee7]/20">
                {{ $badge }}
            </span>
        @endif

        <h1 class="text-4xl font-extrabold text-[#000c46] tracking-tight sm:text-5xl">
            {{ $title }}
        </h1>

        @if ($subtitle)
            <p class="text-base text-[#454652] sm:text-lg max-w-2xl {{ $backLink ? '' : 'mx-auto' }} leading-relaxed">
                {{ $subtitle }}
            </p>
        @endif

        @if ($location)
            <p class="text-base font-semibold text-[#454652] flex items-center gap-2">
                <svg class="h-5 w-5 text-[#0453cd]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                </svg>
                Lokasi: {{ $location }}
            </p>
        @endif
    </div>
</section>
