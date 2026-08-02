@props(['organization'])

<section class="space-y-10">
    <x-common.section-header 
        badge="Arah Organisasi"
        title="Visi & Misi Organisasi" 
        subtitle="Landasan dan tujuan utama dalam setiap langkah pergerakan HIMSI UBSI" />

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
        {{-- Visi Card --}}
        <div class="lg:col-span-5 rounded-3xl bg-gradient-to-br from-[#000c46] via-[#00145c] to-[#001b79] p-8 sm:p-10 text-white space-y-6 shadow-[0_12px_32px_rgba(0,27,121,0.12)] relative overflow-hidden flex flex-col justify-between">
            <div class="space-y-4 relative z-10">
                <span class="inline-block rounded-full bg-white/10 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-white border border-white/20 backdrop-blur-xs">
                    Visi HIMSI
                </span>
                <h3 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Visi Utama</h3>
                <p class="text-base sm:text-lg text-slate-200 leading-relaxed italic pt-2">
                    "{{ $organization['vision'] }}"
                </p>
            </div>
            <div class="pt-6 border-t border-white/10 relative z-10 flex items-center justify-between text-xs font-semibold text-slate-300">
                <span>Landasan Utama Pergerakan</span>
                <span class="text-white font-bold">HIMSI UBSI</span>
            </div>
        </div>

        {{-- Misi Card --}}
        <div class="lg:col-span-7 rounded-3xl bg-white p-8 sm:p-10 border border-[#c5c5d4]/60 shadow-[0_4px_20px_rgba(0,27,121,0.04)] hover:shadow-[0_12px_32px_rgba(0,27,121,0.12)] transition-all duration-300 space-y-6 flex flex-col justify-between">
            <div class="space-y-4">
                <span class="inline-block rounded-full bg-[#001b79]/10 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-[#001b79]">
                    Misi Pergerakan
                </span>
                <h3 class="text-2xl sm:text-3xl font-extrabold text-[#000c46] tracking-tight">Misi Strategis</h3>
                @if (count($organization['mision']) > 0)
                    <ul class="space-y-4 pt-2">
                        @foreach ($organization['mision'] as $misi)
                            <li class="flex items-start gap-3.5 text-sm sm:text-base text-[#454652] leading-relaxed">
                                <div class="h-6 w-6 rounded-xl bg-[#001b79]/10 text-[#0453cd] flex items-center justify-center shrink-0 mt-0.5 font-extrabold text-xs shadow-xs">
                                    ✓
                                </div>
                                <span>{{ is_array($misi) ? ($misi['value'] ?? implode(', ', $misi)) : $misi }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-sm text-slate-400">Belum ada data misi.</p>
                @endif
            </div>
        </div>
    </div>
</section>
