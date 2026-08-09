@props(['organization'])

<section class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
    <!-- Left Column: Header, Description & Key Info Cards -->
    <div class="lg:col-span-6 space-y-6">
        <x-common.section-header 
            badge="Mengenal HIMSI"
            title="{{ $organization['name'] }}" 
            align="left" />
        
        <div class="prose max-w-none text-base sm:text-lg text-[#454652] leading-relaxed prose-p:mb-4 last:prose-p:mb-0">
            {!! $organization['description'] !!}
        </div>

        <!-- Stacked Email & Sekretariat Cards for Maximum Readability -->
        <div class="space-y-4 pt-2">
            <!-- Sekretariat Card -->
            <div class="group p-5 sm:p-6 rounded-2xl bg-white border border-[#c5c5d4]/60 border-l-4 border-l-[#001b79] shadow-[0_4px_20px_rgba(0,27,121,0.04)] hover:shadow-[0_12px_32px_rgba(0,27,121,0.12)] hover:border-[#0453cd]/40 transition-all duration-300 flex items-center gap-4.5 w-full">
                <div class="h-12 w-12 rounded-2xl bg-[#001b79] text-white flex items-center justify-center shrink-0 shadow-md group-hover:scale-105 transition-transform duration-300">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div class="space-y-1 flex-1 min-w-0">
                    <span class="inline-flex items-center gap-1.5 text-[11px] font-extrabold text-[#001b79] uppercase tracking-wider">
                        <span class="h-1.5 w-1.5 rounded-full bg-[#001b79]"></span>
                        Alamat Sekretariat
                    </span>
                    <p class="text-sm font-bold text-[#000c46] leading-relaxed">{{ $organization['address'] }}</p>
                </div>
            </div>

            <!-- Email Resmi Card -->
            <div class="group p-5 sm:p-6 rounded-2xl bg-white border border-[#c5c5d4]/60 border-l-4 border-l-[#0453cd] shadow-[0_4px_20px_rgba(0,27,121,0.04)] hover:shadow-[0_12px_32px_rgba(0,27,121,0.12)] hover:border-[#0453cd]/40 transition-all duration-300 flex items-center gap-4.5 w-full">
                <div class="h-12 w-12 rounded-2xl bg-[#0453cd] text-white flex items-center justify-center shrink-0 shadow-md group-hover:scale-105 transition-transform duration-300">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="space-y-1 flex-1 min-w-0">
                    <span class="inline-flex items-center gap-1.5 text-[11px] font-extrabold text-[#0453cd] uppercase tracking-wider">
                        <span class="h-1.5 w-1.5 rounded-full bg-[#0453cd]"></span>
                        Email Resmi
                    </span>
                    <p class="text-sm font-bold text-[#0453cd] leading-relaxed hover:underline">
                        <a href="mailto:{{ $organization['email'] }}">{{ $organization['email'] }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Original Photo Showcase -->
    <div class="lg:col-span-6">
        <div class="relative rounded-3xl overflow-hidden border border-[#c5c5d4]/60 shadow-[0_12px_32px_rgba(0,27,121,0.08)] group">
            <div class="aspect-[4/3] overflow-hidden bg-slate-100 relative flex items-center justify-center">
                <x-common.image :src="$organization['thumbnail_url']" :alt="$organization['name']" class="h-full w-full object-cover group-hover:scale-105 transition-all duration-500" />
                <div class="absolute top-4 right-4 z-10">
                    <span class="rounded-full bg-white/90 backdrop-blur-xs px-3.5 py-1 text-xs font-bold text-[#001b79] shadow-sm">
                        Profil Organisasi
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>
