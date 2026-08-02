@props([
    'title' => 'Ingin Berkontribusi & Menjadi Bagian Dari HIMSI?',
    'subtitle' => 'Bergabunglah dengan komunitas mahasiswa Sistem Informasi UBSI dan kembangkan potensi diri Anda.',
    'buttonText' => 'Hubungi Pengurus HIMSI',
    'buttonLink' => null,
])

<section class="group relative rounded-3xl bg-gradient-to-br from-[#000c46] via-[#00145c] to-[#001b79] text-white p-8 sm:p-12 lg:p-14 border border-[#001b79] shadow-[0_12px_40px_rgba(0,12,70,0.25)] overflow-hidden my-12 isolate">
    <!-- Top Accent Line -->
    <div class="h-1.5 w-full bg-gradient-to-r from-[#001b79] via-[#0453cd] to-[#356ee7] absolute top-0 left-0"></div>

    <!-- Background Decorative Glow Orbs -->
    <div class="absolute -right-16 -top-16 h-72 w-72 rounded-full bg-[#0453cd]/25 blur-3xl -z-10 pointer-events-none group-hover:scale-125 transition-transform duration-700"></div>
    <div class="absolute -left-16 -bottom-16 h-72 w-72 rounded-full bg-[#356ee7]/20 blur-3xl -z-10 pointer-events-none group-hover:scale-125 transition-transform duration-700"></div>

    <div class="relative mx-auto max-w-3xl text-center space-y-6 z-10">
        <h2 class="text-3xl font-extrabold tracking-tight sm:text-4xl lg:text-5xl text-white leading-tight">
            {{ $title }}
        </h2>
        <p class="text-sm sm:text-base lg:text-lg text-slate-200 max-w-2xl mx-auto leading-relaxed">
            {{ $subtitle }}
        </p>
        <div class="pt-3">
            <a href="{{ $buttonLink ?? route('contact.index') }}"
               class="inline-flex items-center gap-2 rounded-2xl bg-white hover:bg-slate-100 text-[#000c46] px-8 py-4 font-extrabold text-sm sm:text-base shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105 group/btn">
                <span>{{ $buttonText }}</span>
                <svg class="w-5 h-5 group-hover/btn:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
