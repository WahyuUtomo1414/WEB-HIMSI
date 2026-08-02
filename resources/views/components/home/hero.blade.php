@props(['hero'])

<section class="relative bg-gradient-to-b from-[#f0f4ff] via-[#f9f9fc] to-[#f9f9fc] pt-12 pb-20 overflow-hidden">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-7 space-y-6 text-left">
                <span class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-1.5 text-xs font-bold text-[#001b79] border border-[#c5c5d4]/50 shadow-xs">
                    <span class="h-2 w-2 rounded-full bg-[#356ee7]"></span>
                    Official Website HIMSI UBSI
                </span>
                <h1 class="text-4xl font-extrabold text-[#000c46] tracking-tight sm:text-5xl lg:text-6xl leading-tight">
                    {{ $hero['name'] }}
                </h1>
                <p class="text-lg text-[#454652] leading-relaxed">
                    {{ $hero['description'] }}
                </p>
                <div class="pt-4 flex flex-wrap items-center gap-4">
                    <a href="{{ route('about.index') }}" class="rounded-xl bg-[#001b79] px-6 py-3.5 text-base font-semibold text-white transition hover:bg-[#000c46] shadow-md hover:shadow-lg">
                        Tentang Kami
                    </a>
                    <a href="{{ route('contact.index') }}" class="rounded-xl border border-[#001b79] px-6 py-3.5 text-base font-semibold text-[#001b79] transition hover:bg-[#f0f4ff]">
                        Hubungi Kami
                    </a>
                </div>
            </div>

            <div class="lg:col-span-5 relative">
                <div class="relative mx-auto max-w-md lg:max-w-none">
                    <div class="aspect-[4/3] overflow-hidden rounded-3xl border-2 border-white bg-white shadow-2xl">
                        <img src="{{ $hero['thumbnail_url'] }}" alt="{{ $hero['name'] }}" class="h-full w-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
