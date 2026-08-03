@props(['division'])

<section class="relative bg-gradient-to-br from-[#000c46] via-[#00145c] to-[#001b79] text-white pt-24 pb-16 sm:pt-28 sm:pb-20 lg:pt-32 lg:pb-24 border-b border-[#001b79] overflow-hidden isolate">
    <!-- Subtle Background Glows & Accent Light Rays -->
    <div class="absolute -left-20 -top-20 h-80 w-80 rounded-full bg-[#0453cd]/25 blur-3xl -z-10 pointer-events-none"></div>
    <div class="absolute -right-20 -bottom-20 h-80 w-80 rounded-full bg-[#356ee7]/25 blur-3xl -z-10 pointer-events-none"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 h-96 w-96 rounded-full bg-amber-500/10 blur-3xl -z-10 pointer-events-none"></div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-6 relative z-10">
        
        <!-- Contextual Back Link -->
        <div class="flex items-center">
            <a href="{{ route('about.index') }}" 
               class="inline-flex items-center gap-2 rounded-full bg-white/10 hover:bg-white/20 text-slate-200 hover:text-white border border-white/20 px-4 py-2 text-xs font-bold backdrop-blur-md transition-all duration-300 hover:scale-105 shadow-sm group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
                </svg>
                <span>Kembali ke Tentang Kami</span>
            </a>
        </div>

        <!-- Division Header Content -->
        <div class="pt-4 flex items-center justify-between gap-6 border-t border-white/10">
            <div class="flex items-center gap-5">
                <div class="h-20 w-20 sm:h-24 sm:w-24 rounded-3xl bg-white p-3 border-2 border-white/30 shadow-2xl flex items-center justify-center shrink-0">
                    <img src="{{ $division['logo_url'] }}" alt="{{ $division['name'] }}" class="h-full w-full object-contain">
                </div>
                <div class="space-y-2">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-500/20 text-amber-300 border border-amber-500/40 px-3.5 py-1 text-xs font-extrabold backdrop-blur-md">
                            <span class="h-2 w-2 rounded-full bg-amber-400 animate-pulse"></span>
                            <span>Divisi Resmi HIMSI UBSI</span>
                        </span>
                        @if (isset($division['is_dpp']) && $division['is_dpp'])
                            <span class="rounded-full bg-white/20 px-3 py-1 text-xs font-bold text-white uppercase tracking-wider backdrop-blur-md border border-white/30">
                                DPP PUSAT
                            </span>
                        @endif
                    </div>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight leading-tight">
                        {{ $division['name'] }}
                    </h1>
                </div>
            </div>
        </div>

    </div>
</section>
