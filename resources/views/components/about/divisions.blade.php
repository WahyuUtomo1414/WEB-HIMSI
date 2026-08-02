@props(['divisions'])

<section class="space-y-10">
    <x-common.section-header 
        badge="Divisi"
        title="Daftar Divisi Organisasi" 
        subtitle="Divisi pendukung utama operasional dan program kerja Himpunan Mahasiswa Sistem Informasi" />

    @if (count($divisions) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($divisions as $division)
                <div class="card-nexus rounded-2xl p-6 space-y-4">
                    <div class="h-12 w-12 rounded-xl bg-[#f0f4ff] p-2 flex items-center justify-center">
                        <img src="{{ $division['logo_url'] }}" alt="{{ $division['name'] }}" class="h-full w-full object-contain">
                    </div>
                    <h3 class="text-xl font-bold text-[#000c46]">{{ $division['name'] }}</h3>
                    <p class="text-sm text-[#454652] leading-relaxed">{{ $division['description'] }}</p>
                    <div class="pt-2">
                        <a href="{{ route('division.show', $division['id']) }}" class="text-sm font-bold text-[#0453cd] hover:underline">
                            Detail Divisi & Tasks &rarr;
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</section>
