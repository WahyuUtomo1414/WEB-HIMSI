@props(['title', 'subtitle' => null, 'backLink' => null, 'badge' => null, 'location' => null])

<section class="relative bg-gradient-to-br from-[#000c46] via-[#00145c] to-[#001b79] text-white pt-28 pb-16 sm:pt-32 sm:pb-20 lg:pt-36 lg:pb-24 border-b border-[#001b79] overflow-hidden isolate">

    {{-- SVG dot-grid pattern --}}
    <div class="absolute inset-0 -z-10 pointer-events-none overflow-hidden">
        <svg class="absolute inset-0 w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="branch-hero-pattern" width="32" height="32" patternUnits="userSpaceOnUse">
                    <circle cx="0"  cy="0"  r="1.2" fill="white" fill-opacity="0.13"/>
                    <circle cx="32" cy="0"  r="1.2" fill="white" fill-opacity="0.13"/>
                    <circle cx="0"  cy="32" r="1.2" fill="white" fill-opacity="0.13"/>
                    <circle cx="32" cy="32" r="1.2" fill="white" fill-opacity="0.13"/>
                    <line x1="0" y1="0" x2="32" y2="0"  stroke="white" stroke-opacity="0.04" stroke-width="0.5"/>
                    <line x1="0" y1="0" x2="0"  y2="32" stroke="white" stroke-opacity="0.04" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#branch-hero-pattern)"/>
        </svg>
    </div>

    {{-- Ambient glows --}}
    <div class="absolute -left-20 -top-20 h-72 w-72 rounded-full bg-[#0453cd]/25 blur-3xl -z-10 pointer-events-none"></div>
    <div class="absolute -right-20 -bottom-20 h-72 w-72 rounded-full bg-[#356ee7]/25 blur-3xl -z-10 pointer-events-none"></div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 {{ $backLink ? 'space-y-4' : 'text-center space-y-4' }} relative z-10">
        @if ($backLink)
            <div class="flex items-center">
                <a href="{{ $backLink }}" class="inline-flex items-center gap-2 rounded-full bg-white/10 hover:bg-white/20 border border-white/20 px-4 py-1.5 text-xs font-bold text-white transition-all backdrop-blur-xs shadow-xs hover:border-white/40 group">
                    <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
                    </svg>
                    <span>Kembali ke Daftar Cabang</span>
                </a>
            </div>
        @endif

        @if ($badge)
            <span class="inline-flex items-center gap-1.5 rounded-full bg-white/10 px-3.5 py-1 text-xs font-bold text-white border border-white/20 uppercase tracking-wider backdrop-blur-xs">
                {{ $badge }}
            </span>
        @endif

        <h1 class="text-4xl font-extrabold text-white tracking-tight sm:text-5xl lg:text-6xl">
            {!! $title !!}
        </h1>

        @if ($subtitle)
            <p class="text-base text-slate-200 sm:text-lg max-w-2xl {{ $backLink ? '' : 'mx-auto' }} leading-relaxed">
                {{ $subtitle }}
            </p>
        @endif

        @if ($location)
            <p class="text-base font-semibold text-slate-200 flex items-center gap-2 {{ $backLink ? '' : 'justify-center' }}">
                <svg class="h-5 w-5 text-[#356ee7]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span>Lokasi: {{ $location }}</span>
            </p>
        @endif
    </div>
</section>
