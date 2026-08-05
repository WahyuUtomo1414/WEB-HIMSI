@props(['blog'])

<div x-data="{ activeImage: null, activeDesc: null }" class="space-y-6">
    <article class="rich-content prose prose-lg max-w-none">
        {!! $blog['body'] !!}
    </article>

    @if (!empty($blog['images']) && count($blog['images']) > 0)
        <div class="space-y-4 pt-6">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-[#000c46]">Dokumentasi Tambahan</h3>
                <span class="text-xs text-[#454652] hidden sm:inline-block">Klik gambar untuk memperbesar</span>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach ($blog['images'] as $img)
                    <div @click="activeImage = '{{ $img['image_url'] }}'; activeDesc = '{{ addslashes($img['description'] ?? '') }}'" 
                         class="group cursor-pointer rounded-2xl overflow-hidden border border-[#c5c5d4]/60 shadow-[0_4px_16px_rgba(0,27,121,0.04)] hover:shadow-[0_8px_24px_rgba(0,27,121,0.12)] hover:border-[#0453cd]/40 transition-all duration-300 bg-white">
                        <div class="h-48 sm:h-52 w-full overflow-hidden relative bg-[#f0f4ff]/70 flex items-center justify-center">
                            <img src="{{ $img['image_url'] }}" alt="{{ $img['description'] ?? '' }}" loading="lazy" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500">
                            
                            <!-- Hover Overlay & Zoom Icon -->
                            <div class="absolute inset-0 bg-[#000c46]/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center text-white gap-2 font-bold text-xs backdrop-blur-xs">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607zM10.5 7.5v6m3-3h-6"/>
                                </svg>
                                <span>Perbesar Gambar</span>
                            </div>
                        </div>
                        @if (!empty($img['description']))
                            <p class="p-3 text-xs font-semibold text-[#454652] bg-white border-t border-slate-100 flex items-center gap-2">
                                <svg class="w-3.5 h-3.5 text-[#0453cd] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                                <span>{{ $img['description'] }}</span>
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Ultra-Clean Minimal Image Lightbox Modal Overlay -->
    <template x-teleport="body">
        <div x-show="activeImage" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @keydown.window.escape="activeImage = null"
             @click="activeImage = null"
             class="fixed inset-0 z-[9999] flex flex-col items-center justify-center p-4 bg-black/90 backdrop-blur-sm cursor-zoom-out"
             style="display: none;">
            
            <!-- Floating Close Button -->
            <button @click.stop="activeImage = null" class="fixed top-5 right-5 h-10 w-10 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors z-20">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Clean Floating Image -->
            <div @click.stop class="relative max-w-5xl max-h-[85vh] flex flex-col items-center cursor-default">
                <img :src="activeImage" :alt="activeDesc" loading="lazy" class="max-h-[80vh] w-auto max-w-full object-contain rounded-2xl shadow-2xl border border-white/10">
                <template x-if="activeDesc">
                    <p class="mt-3 text-xs sm:text-sm font-semibold text-slate-300 text-center max-w-xl" x-text="activeDesc"></p>
                </template>
            </div>
        </div>
    </template>
</div>
