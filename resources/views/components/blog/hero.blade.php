@props(['hero'])

<section class="relative bg-gradient-to-br from-[#000c46] via-[#00145c] to-[#001b79] text-white pt-28 pb-16 sm:pt-32 sm:pb-20 lg:pt-36 lg:pb-24 border-b border-[#001b79] overflow-hidden isolate">

    {{-- SVG dot-grid pattern --}}
    <div class="absolute inset-0 -z-10 pointer-events-none overflow-hidden">
        <svg class="absolute inset-0 w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="blog-index-hero-pattern" width="32" height="32" patternUnits="userSpaceOnUse">
                    <circle cx="0"  cy="0"  r="1.2" fill="white" fill-opacity="0.13"/>
                    <circle cx="32" cy="0"  r="1.2" fill="white" fill-opacity="0.13"/>
                    <circle cx="0"  cy="32" r="1.2" fill="white" fill-opacity="0.13"/>
                    <circle cx="32" cy="32" r="1.2" fill="white" fill-opacity="0.13"/>
                    <line x1="0" y1="0" x2="32" y2="0"  stroke="white" stroke-opacity="0.04" stroke-width="0.5"/>
                    <line x1="0" y1="0" x2="0"  y2="32" stroke="white" stroke-opacity="0.04" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#blog-index-hero-pattern)"/>
        </svg>
    </div>

    {{-- Ambient glows --}}
    <div class="absolute -left-20 -top-20 h-72 w-72 rounded-full bg-[#0453cd]/25 blur-3xl -z-10 pointer-events-none"></div>
    <div class="absolute -right-20 -bottom-20 h-72 w-72 rounded-full bg-[#356ee7]/25 blur-3xl -z-10 pointer-events-none"></div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center space-y-4 relative z-10">
        <span class="inline-flex items-center gap-1.5 rounded-full bg-white/10 px-3.5 py-1 text-xs font-bold text-white border border-white/20 uppercase tracking-wider backdrop-blur-xs">
            Publikasi & Kabar
        </span>
        <h1 class="text-4xl font-extrabold text-white tracking-tight sm:text-5xl lg:text-6xl">
            {{ $hero['title'] }}
        </h1>
        <p class="text-base text-slate-200 sm:text-lg max-w-2xl mx-auto leading-relaxed">
            {{ $hero['subtitle'] }}
        </p>
    </div>
</section>
