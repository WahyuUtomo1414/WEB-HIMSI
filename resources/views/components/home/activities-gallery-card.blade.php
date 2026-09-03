@props(['item'])

<a href="{{ $item['detail_url'] ?? '#' }}"
   class="group relative block w-[320px] sm:w-[380px] md:w-[412px] h-[200px] sm:h-[237px] shrink-0 rounded-2xl overflow-hidden border border-[#c5c5d4]/40 bg-[#000c46] shadow-md transition-all duration-500">

    @if (!empty($item['image_url']))
        <img src="{{ $item['image_url'] }}"
             alt="{{ $item['description'] ?? $item['title'] }}"
             loading="lazy"
             class="h-full w-full object-cover filter grayscale contrast-105 brightness-90 group-hover:filter-none group-hover:scale-105 transition-all duration-500"
             onerror="this.closest('a').querySelector('.himsi-img-fallback').classList.remove('hidden'); this.remove();">
    @endif

    <div class="himsi-img-fallback h-full w-full bg-[#001b79]/40 flex flex-col items-center justify-center gap-3 text-slate-300 p-6 text-center group-hover:bg-[#001b79]/60 transition-colors {{ !empty($item['image_url']) ? 'hidden absolute inset-0' : '' }}">
        <svg class="w-12 h-12 text-amber-400/80 group-hover:scale-110 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V7.5zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
        </svg>
        <span class="text-xs font-semibold tracking-wide text-slate-200">Dokumentasi Foto Kegiatan</span>
    </div>

    <!-- Dark Overlay Gradient -->
    <div class="absolute inset-0 bg-gradient-to-t from-[#000c46] via-[#000c46]/30 to-transparent opacity-60 group-hover:opacity-90 transition-opacity duration-300 pointer-events-none"></div>

    <!-- Top Badges -->
    <div class="absolute top-3.5 left-3.5 right-3.5 flex items-center justify-between z-10 pointer-events-none">
        <span class="rounded-full bg-black/50 backdrop-blur-md border border-white/20 px-3 py-1 text-[10px] font-extrabold text-white uppercase tracking-wider">
            {{ $item['category_name'] ?? 'KEGIATAN' }}
        </span>
        <span class="rounded-full bg-[#001b79]/85 backdrop-blur-md px-3 py-1 text-[10px] font-bold text-amber-300 border border-[#356ee7]/40 shadow-xs">
            {{ $item['branch_name'] ?? 'HIMSI UBSI' }}
        </span>
    </div>

    <!-- Quote Overlay on Hover -->
    <div class="absolute inset-x-0 bottom-0 p-5 z-10 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-3 group-hover:translate-y-0 text-white pointer-events-none">
        <p class="text-xs sm:text-sm font-bold leading-snug text-amber-300 drop-shadow-sm">
            "{{ $item['description'] ?? $item['title'] }}"
        </p>
    </div>

</a>
