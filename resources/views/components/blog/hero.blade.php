@props(['hero'])

<section class="bg-gradient-to-b from-[#f0f4ff] to-[#f9f9fc] py-16 border-b border-[#c5c5d4]/40">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center space-y-4">
        <span class="inline-flex items-center gap-1.5 rounded-full bg-white px-3.5 py-1 text-xs font-semibold text-[#0453cd] border border-[#356ee7]/20">
            Publikasi & Kabar
        </span>
        <h1 class="text-4xl font-extrabold text-[#000c46] tracking-tight sm:text-5xl">
            {{ $hero['title'] }}
        </h1>
        <p class="text-base text-[#454652] sm:text-lg max-w-2xl mx-auto leading-relaxed">
            {{ $hero['subtitle'] }}
        </p>
    </div>
</section>
