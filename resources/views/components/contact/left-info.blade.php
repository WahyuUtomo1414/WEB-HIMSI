@props(['organization'])

<div class="space-y-8">
    <div class="space-y-4">
        <span class="inline-block rounded-lg bg-[#f0f4ff] px-3 py-1 text-xs font-bold uppercase tracking-wider text-[#0453cd]">Informasi Resmi</span>
        <h2 class="text-3xl font-extrabold text-[#000c46]">Sekretariat HIMSI</h2>
        <p class="text-sm text-[#454652] leading-relaxed">
            Anda dapat menghubungi pengurus HIMSI UBSI melalui kontak resmi di bawah ini atau mengisi formulir pesan di samping.
        </p>
    </div>

    {{-- Contact Cards --}}
    <div class="space-y-4">
        <div class="card-nexus rounded-2xl p-5 flex items-start gap-4">
            <div class="h-10 w-10 rounded-xl bg-[#f0f4ff] text-[#001b79] flex items-center justify-center shrink-0">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div>
                <h4 class="text-xs font-bold text-[#454652] uppercase">Alamat</h4>
                <p class="text-sm font-bold text-[#000c46] mt-0.5">{{ $organization['address'] }}</p>
            </div>
        </div>

        <div class="card-nexus rounded-2xl p-5 flex items-start gap-4">
            <div class="h-10 w-10 rounded-xl bg-[#f0f4ff] text-[#001b79] flex items-center justify-center shrink-0">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <h4 class="text-xs font-bold text-[#454652] uppercase">Email</h4>
                <p class="text-sm font-bold text-[#0453cd] mt-0.5">{{ $organization['email'] }}</p>
            </div>
        </div>

        <div class="card-nexus rounded-2xl p-5 flex items-start gap-4">
            <div class="h-10 w-10 rounded-xl bg-[#f0f4ff] text-[#001b79] flex items-center justify-center shrink-0">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
            </div>
            <div>
                <h4 class="text-xs font-bold text-[#454652] uppercase">Telepon</h4>
                <p class="text-sm font-bold text-[#000c46] mt-0.5">{{ $organization['no_tlpn'] }}</p>
            </div>
        </div>
    </div>

    {{-- Social Media List --}}
    <div class="card-nexus rounded-2xl p-6 bg-white space-y-3">
        <h4 class="text-sm font-bold text-[#000c46]">Media Sosial Resmi:</h4>
        <div class="space-y-2 text-sm">
            @foreach ($organization['sosial_media'] as $medsos)
                <div class="flex items-center gap-2 text-[#0453cd]">
                    <span class="h-2 w-2 rounded-full bg-[#356ee7]"></span>
                    <span class="font-semibold">{{ is_array($medsos) ? ($medsos['platform'] ?? ($medsos['value'] ?? implode(', ', $medsos))) : $medsos }}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>
