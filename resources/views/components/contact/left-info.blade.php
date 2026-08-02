@props(['organization'])

<div class="space-y-8">
    <div class="space-y-3">
        <span class="inline-block rounded-full bg-[#001b79]/10 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-[#001b79] border border-[#001b79]/15">Informasi Resmi</span>
        <h2 class="text-3xl sm:text-4xl font-extrabold text-[#000c46]">Sekretariat HIMSI</h2>
        <p class="text-xs sm:text-sm text-[#454652] leading-relaxed">
            Anda dapat menghubungi pengurus HIMSI UBSI melalui kontak resmi di bawah ini atau mengisi formulir pesan di samping.
        </p>
    </div>

    {{-- Contact Cards with Top Accent Borders & Solid Icon Boxes --}}
    <div class="space-y-4">
        <!-- Alamat Card -->
        <div class="group relative rounded-3xl bg-white p-6 border-t-4 border-t-[#001b79] border border-[#c5c5d4]/60 shadow-[0_4px_20px_rgba(0,27,121,0.04)] hover:shadow-[0_8px_24px_rgba(0,27,121,0.1)] transition-all duration-300 flex items-start gap-4">
            <div class="h-11 w-11 rounded-2xl bg-[#001b79] text-white flex items-center justify-center shrink-0 shadow-sm group-hover:scale-105 transition-transform">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                </svg>
            </div>
            <div class="space-y-1 min-w-0">
                <div class="flex items-center gap-2">
                    <h4 class="text-xs font-bold text-[#454652] uppercase tracking-wider">Alamat Sekretariat</h4>
                    <span class="h-2 w-2 rounded-full bg-[#001b79] animate-pulse"></span>
                </div>
                <p class="text-sm font-bold text-[#000c46] leading-snug">{{ $organization['address'] }}</p>
            </div>
        </div>

        <!-- Email Card -->
        <div class="group relative rounded-3xl bg-white p-6 border-t-4 border-t-[#0453cd] border border-[#c5c5d4]/60 shadow-[0_4px_20px_rgba(0,27,121,0.04)] hover:shadow-[0_8px_24px_rgba(0,27,121,0.1)] transition-all duration-300 flex items-start gap-4">
            <div class="h-11 w-11 rounded-2xl bg-[#0453cd] text-white flex items-center justify-center shrink-0 shadow-sm group-hover:scale-105 transition-transform">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                </svg>
            </div>
            <div class="space-y-1 min-w-0">
                <div class="flex items-center gap-2">
                    <h4 class="text-xs font-bold text-[#454652] uppercase tracking-wider">Email Resmi</h4>
                    <span class="h-2 w-2 rounded-full bg-[#0453cd] animate-pulse"></span>
                </div>
                <p class="text-sm font-bold text-[#0453cd] leading-snug truncate">{{ $organization['email'] }}</p>
            </div>
        </div>

        <!-- Telepon Card -->
        <div class="group relative rounded-3xl bg-white p-6 border-t-4 border-t-[#356ee7] border border-[#c5c5d4]/60 shadow-[0_4px_20px_rgba(0,27,121,0.04)] hover:shadow-[0_8px_24px_rgba(0,27,121,0.1)] transition-all duration-300 flex items-start gap-4">
            <div class="h-11 w-11 rounded-2xl bg-[#356ee7] text-white flex items-center justify-center shrink-0 shadow-sm group-hover:scale-105 transition-transform">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.826-1.07-5.158-3.402-6.228-6.228l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                </svg>
            </div>
            <div class="space-y-1 min-w-0">
                <div class="flex items-center gap-2">
                    <h4 class="text-xs font-bold text-[#454652] uppercase tracking-wider">Layanan Telepon</h4>
                </div>
                <p class="text-sm font-bold text-[#000c46] leading-snug">{{ $organization['no_tlpn'] }}</p>
            </div>
        </div>
    </div>

    {{-- Social Media Grid --}}
    <div class="rounded-3xl p-6 bg-white border border-[#c5c5d4]/60 shadow-[0_4px_20px_rgba(0,27,121,0.04)] space-y-4">
        <h4 class="text-sm font-bold text-[#000c46]">Media Sosial Resmi:</h4>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            @foreach ($organization['sosial_media'] as $medsos)
                @php
                    $platform = is_array($medsos) ? ($medsos['platform'] ?? 'Media Sosial') : 'Media Sosial';
                    $val = is_array($medsos) ? ($medsos['url'] ?? ($medsos['value'] ?? implode(', ', $medsos))) : $medsos;
                @endphp
                <div class="group p-3 rounded-2xl bg-[#f0f4ff]/70 border border-[#356ee7]/20 hover:border-[#0453cd]/40 hover:bg-white transition-all duration-300 flex items-center justify-between gap-2 shadow-xs">
                    <div class="flex items-center gap-2 min-w-0">
                        <span class="h-2 w-2 rounded-full bg-[#0453cd] shrink-0"></span>
                        <div class="min-w-0">
                            <span class="block text-[10px] font-bold text-[#454652] uppercase tracking-wider">{{ $platform }}</span>
                            <span class="text-xs font-bold text-[#001b79] truncate block">{{ $val }}</span>
                        </div>
                    </div>
                    <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-[#0453cd] group-hover:translate-x-0.5 transition-all shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                    </svg>
                </div>
            @endforeach
        </div>
    </div>
</div>
