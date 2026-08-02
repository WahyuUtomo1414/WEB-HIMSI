@props([
    'title' => 'Ingin Berkontribusi & Menjadi Bagian Dari HIMSI?',
    'subtitle' => 'Bergabunglah dengan komunitas mahasiswa Sistem Informasi UBSI dan kembangkan potensi diri Anda.',
    'buttonText' => 'Hubungi Pengurus HIMSI',
    'buttonLink' => null
])

<section class="py-16 bg-gradient-to-br from-[#000c46] to-[#001b79] text-white rounded-3xl overflow-hidden shadow-xl relative my-12">
    <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-[#356ee7]/10 blur-3xl"></div>
    <div class="absolute -left-20 -bottom-20 h-64 w-64 rounded-full bg-[#0453cd]/20 blur-3xl"></div>

    <div class="relative mx-auto max-w-4xl px-6 text-center space-y-6">
        <h2 class="text-3xl font-extrabold tracking-tight sm:text-4xl text-white">
            {{ $title }}
        </h2>
        <p class="text-base text-slate-200 sm:text-lg max-w-2xl mx-auto leading-relaxed">
            {{ $subtitle }}
        </p>
        <div class="pt-2">
            <a href="{{ $buttonLink ?? route('contact.index') }}" 
               class="inline-flex items-center justify-center rounded-xl bg-white px-7 py-3.5 text-base font-bold text-[#000c46] shadow-lg transition hover:bg-slate-100 hover:scale-105">
                {{ $buttonText }}
            </a>
        </div>
    </div>
</section>
