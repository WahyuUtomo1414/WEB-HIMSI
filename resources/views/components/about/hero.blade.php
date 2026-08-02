@props(['hero'])

<section class="relative bg-gradient-to-br from-[#000c46] via-[#00145c] to-[#001b79] text-white pt-28 pb-16 sm:pt-32 sm:pb-20 lg:pt-36 lg:pb-24 border-b border-[#001b79] overflow-hidden isolate">
    <!-- Subtle Background Glows -->
    <div class="absolute -left-20 -top-20 h-72 w-72 rounded-full bg-[#0453cd]/20 blur-3xl -z-10 pointer-events-none"></div>
    <div class="absolute -right-20 -bottom-20 h-72 w-72 rounded-full bg-[#356ee7]/20 blur-3xl -z-10 pointer-events-none"></div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center space-y-4 relative z-10">
        <span class="inline-flex items-center gap-1.5 rounded-full bg-white/10 px-3.5 py-1 text-xs font-bold text-white border border-white/20 uppercase tracking-wider backdrop-blur-xs">
            Profil HIMSI
        </span>
        <h1 class="text-4xl font-extrabold text-white tracking-tight sm:text-5xl lg:text-6xl">
            {{ $hero['title'] }}
        </h1>
        <p class="text-base text-slate-200 sm:text-lg max-w-2xl mx-auto leading-relaxed">
            {{ $hero['subtitle'] }}
        </p>
    </div>
</section>
