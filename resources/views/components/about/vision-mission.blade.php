@props(['organization'])

<section class="space-y-10">
    <x-common.section-header 
        badge="Arah Organisasi"
        title="Visi & Misi Organisasi" 
        subtitle="Landasan dan tujuan utama dalam setiap langkah pergerakan HIMSI UBSI" />

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        {{-- Visi --}}
        <div class="lg:col-span-5 rounded-3xl bg-gradient-to-br from-[#000c46] to-[#001b79] p-8 text-white space-y-4 shadow-lg">
            <span class="inline-block rounded-lg bg-[#356ee7]/30 px-3 py-1 text-xs font-bold uppercase tracking-wider text-white">Visi</span>
            <h3 class="text-2xl font-bold">Visi Utama</h3>
            <p class="text-base text-slate-200 leading-relaxed italic">
                "{{ $organization['vision'] }}"
            </p>
        </div>

        {{-- Misi --}}
        <div class="lg:col-span-7 rounded-3xl bg-white p-8 border border-slate-200 shadow-sm space-y-4">
            <span class="inline-block rounded-lg bg-[#f0f4ff] px-3 py-1 text-xs font-bold uppercase tracking-wider text-[#0453cd]">Misi</span>
            <h3 class="text-2xl font-bold text-[#000c46]">Misi Pergerakan</h3>
            @if (count($organization['mision']) > 0)
                <ul class="space-y-3 pt-2">
                    @foreach ($organization['mision'] as $misi)
                        <li class="flex items-start gap-3 text-sm text-[#454652]">
                            <span class="h-5 w-5 rounded-full bg-[#f0f4ff] text-[#0453cd] flex items-center justify-center shrink-0 mt-0.5 font-bold text-xs">✓</span>
                            <span>{{ is_array($misi) ? ($misi['value'] ?? implode(', ', $misi)) : $misi }}</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-sm text-slate-400">Belum ada data misi.</p>
            @endif
        </div>
    </div>
</section>
