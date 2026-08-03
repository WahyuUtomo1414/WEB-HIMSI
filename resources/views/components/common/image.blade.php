@props([
    'src' => '',
    'alt' => '',
    'class' => 'h-full w-full object-cover',
    'containerClass' => 'h-full w-full relative overflow-hidden',
])

<div x-data="{ loaded: false, error: false }" class="{{ $containerClass }}">
    <!-- Shimmer Skeleton Loading Placeholder -->
    <div x-show="!loaded && !error" 
         class="absolute inset-0 z-10 bg-slate-200/90 animate-pulse flex items-center justify-center">
        <div class="flex flex-col items-center gap-2">
            <svg class="w-8 h-8 text-slate-400 animate-spin" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Memuat...</span>
        </div>
    </div>

    <!-- Fallback if Image Fails -->
    <div x-show="error" 
         class="absolute inset-0 z-10 bg-slate-100 flex items-center justify-center p-4 text-center">
        <span class="text-xs font-semibold text-slate-400">Gambar Tidak Tersedia</span>
    </div>

    <!-- Actual Image from DB -->
    <img src="{{ $src }}" 
         alt="{{ $alt }}" 
         loading="lazy"
         x-on:load="loaded = true"
         x-on:error="error = true; loaded = true"
         :class="{ 'opacity-0 scale-95': !loaded, 'opacity-100 scale-100': loaded }"
         class="transition-all duration-500 ease-out {{ $class }}">
</div>
