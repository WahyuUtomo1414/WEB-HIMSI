@props(['divisions'])

<section class="space-y-10">
    <x-common.section-header 
        badge="Organisasi"
        title="Divisi HIMSI" 
        subtitle="Struktur divisi yang menjalankan roda organisasi dan program kerja HIMSI UBSI" />

    @if (count($divisions) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($divisions as $division)
                <div class="card-nexus rounded-2xl p-6 space-y-4 flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="h-12 w-12 rounded-xl bg-[#f0f4ff] p-2 flex items-center justify-center">
                                <img src="{{ $division['logo_url'] }}" alt="{{ $division['name'] }}" class="h-full w-full object-contain">
                            </div>
                            @if ($division['is_dpp'])
                                <span class="rounded-full bg-[#000c46] px-2.5 py-0.5 text-[10px] font-bold text-white uppercase">DPP</span>
                            @endif
                        </div>
                        <h3 class="text-xl font-bold text-[#000c46]">{{ $division['name'] }}</h3>
                        <p class="text-sm text-[#454652] line-clamp-3 leading-relaxed">{{ $division['description'] }}</p>
                    </div>
                    <div class="pt-2">
                        <a href="{{ route('division.show', $division['id']) }}" class="inline-flex items-center text-sm font-bold text-[#0453cd] hover:text-[#000c46]">
                            Lihat Detail Divisi &rarr;
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <x-common.empty-state title="Belum Ada Divisi" message="Data divisi organisasi akan segera diperbarui." />
    @endif
</section>
