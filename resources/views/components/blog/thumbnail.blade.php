@props(['blog'])

<div x-data="{ openModal: false }" class="relative">
    <div @click="openModal = true" class="group cursor-pointer aspect-[16/9] overflow-hidden rounded-3xl border border-[#c5c5d4]/60 shadow-[0_8px_30px_rgba(0,27,121,0.08)] bg-[#f0f4ff]/70 relative">
        <x-common.image :src="$blog['thumbnail_url']" :alt="$blog['title']" class="h-full w-full object-cover group-hover:scale-105 transition-all duration-500" />
        
        <!-- Hover Overlay & Zoom Icon -->
        <div class="absolute inset-0 bg-[#000c46]/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center text-white gap-2 font-bold text-sm backdrop-blur-xs">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607zM10.5 7.5v6m3-3h-6"/>
            </svg>
            <span>Klik Untuk Memperbesar Gambar Utama</span>
        </div>
    </div>

    <!-- Image Lightbox Modal -->
    <template x-teleport="body">
        <div x-show="openModal" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @keydown.window.escape="openModal = false"
             @click="openModal = false"
             class="fixed inset-0 z-[9999] flex flex-col items-center justify-center p-4 bg-black/90 backdrop-blur-sm cursor-zoom-out"
             style="display: none;">
            
            <!-- Floating Close Button -->
            <button @click.stop="openModal = false" class="fixed top-5 right-5 h-10 w-10 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors z-20">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Clean Floating Image -->
            <div @click.stop class="relative max-w-5xl max-h-[85vh] flex flex-col items-center cursor-default">
                <img src="{{ $blog['thumbnail_url'] }}" alt="{{ $blog['title'] }}" loading="lazy" class="max-h-[80vh] w-auto max-w-full object-contain rounded-2xl shadow-2xl border border-white/10">
                <p class="mt-3 text-xs sm:text-sm font-semibold text-slate-300 text-center max-w-xl">{{ $blog['title'] }}</p>
            </div>
        </div>
    </template>
</div>
