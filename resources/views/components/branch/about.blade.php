@props(['branch'])

<section class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
    <div class="lg:col-span-7 space-y-6">
        <x-common.section-header 
            badge="Profil Cabang"
            title="Tentang {{ $branch['name'] }}" 
            align="left" />
        
        <p class="text-base sm:text-lg text-[#454652] leading-relaxed">
            {{ $branch['description'] }}
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-2 items-stretch">
            <!-- Sektor Card -->
            <div class="group p-5 rounded-2xl bg-white border border-[#c5c5d4]/60 border-t-4 border-t-[#001b79] shadow-[0_4px_16px_rgba(0,27,121,0.04)] flex items-start gap-4">
                <div class="h-11 w-11 rounded-xl bg-[#001b79] text-white flex items-center justify-center shrink-0 shadow-xs">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h5"/>
                    </svg>
                </div>
                <div class="space-y-1">
                    <span class="text-xs font-bold text-[#454652] uppercase tracking-wider">Sektor Wilayah</span>
                    <p class="text-sm font-bold text-[#000c46] leading-snug">{{ $branch['sektor'] ?? 'Wilayah' }}</p>
                </div>
            </div>

            <!-- Lokasi Card -->
            <div class="group p-5 rounded-2xl bg-white border border-[#c5c5d4]/60 border-t-4 border-t-[#0453cd] shadow-[0_4px_16px_rgba(0,27,121,0.04)] flex items-start gap-4">
                <div class="h-11 w-11 rounded-xl bg-[#0453cd] text-white flex items-center justify-center shrink-0 shadow-xs">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    </svg>
                </div>
                <div class="space-y-1">
                    <span class="text-xs font-bold text-[#454652] uppercase tracking-wider">Lokasi Utama</span>
                    <p class="text-sm font-bold text-[#0453cd] leading-snug">{{ $branch['location'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="lg:col-span-5">
        <div class="relative rounded-3xl overflow-hidden border border-[#c5c5d4]/60 bg-[#f0f4ff]/70 shadow-[0_12px_32px_rgba(0,27,121,0.08)] p-3 group">
            <div class="aspect-[4/3] rounded-2xl overflow-hidden bg-slate-100 relative flex items-center justify-center">
                <img src="{{ $branch['thumbnail_url'] }}" alt="{{ $branch['name'] }}" class="h-full w-full object-contain group-hover:scale-105 transition-transform duration-500">
            </div>
        </div>
    </div>
</section>
