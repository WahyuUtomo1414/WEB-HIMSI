@props(['division'])

<section class="relative bg-gradient-to-br from-[#000c46] via-[#00145c] to-[#001b79] text-white pt-28 pb-16 sm:pt-32 sm:pb-20 lg:pt-36 lg:pb-24 border-b border-[#001b79] overflow-hidden isolate">
    <!-- Subtle Background Glows -->
    <div class="absolute -left-20 -top-20 h-72 w-72 rounded-full bg-[#0453cd]/20 blur-3xl -z-10 pointer-events-none"></div>
    <div class="absolute -right-20 -bottom-20 h-72 w-72 rounded-full bg-[#356ee7]/20 blur-3xl -z-10 pointer-events-none"></div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-4 relative z-10">
        <div class="flex items-center gap-2">
            <a href="{{ route('home') }}" class="inline-flex items-center text-xs font-semibold text-[#356ee7] hover:text-white transition-colors">&larr; Kembali ke Beranda</a>
        </div>
        <div class="flex items-center gap-4 pt-2">
            <div class="h-14 w-14 rounded-2xl bg-white p-2.5 border border-white/20 shadow-lg flex items-center justify-center shrink-0">
                <img src="{{ $division['logo_url'] }}" alt="{{ $division['name'] }}" class="h-full w-full object-contain">
            </div>
            <h1 class="text-3xl font-extrabold text-white tracking-tight sm:text-4xl lg:text-5xl">
                {{ $division['name'] }}
            </h1>
        </div>
    </div>
</section>
