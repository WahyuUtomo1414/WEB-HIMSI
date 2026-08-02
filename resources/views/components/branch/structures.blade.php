@props(['branch', 'structures'])

<section class="space-y-10">
    <x-common.section-header 
        badge="Pengurus"
        title="Struktur Kepengurusan Cabang" 
        subtitle="Daftar pengurus aktif yang memimpin jalannya organisasi di {{ $branch['name'] }}" />

    @if (count($structures) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($structures as $person)
                <div class="card-nexus rounded-2xl overflow-hidden text-center space-y-3 p-5">
                    <div class="h-32 w-32 mx-auto rounded-full overflow-hidden border-2 border-[#356ee7]/20 shadow-md">
                        <img src="{{ $person['image_url'] }}" alt="{{ $person['name'] }}" class="h-full w-full object-cover">
                    </div>
                    <div class="space-y-1">
                        <h4 class="text-base font-bold text-[#000c46]">{{ $person['name'] }}</h4>
                        <p class="text-xs font-semibold text-[#0453cd] uppercase tracking-wider">{{ $person['position'] }}</p>
                        <span class="inline-block text-[11px] font-medium text-[#454652] bg-slate-100 rounded-md px-2 py-0.5 mt-1">
                            {{ $person['division_name'] }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <x-common.empty-state title="Belum Ada Pengurus" message="Data struktur pengurus untuk cabang ini belum ditambahkan." />
    @endif
</section>
