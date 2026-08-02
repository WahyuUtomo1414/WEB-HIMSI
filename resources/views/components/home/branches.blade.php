@props(['branches'])

<section class="space-y-10">
    <x-common.section-header 
        badge="Wilayah"
        title="Cabang & DPC HIMSI" 
        subtitle="Jaringan kepengurusan HIMSI di berbagai sektor dan wilayah kampus UBSI" />

    @if (count($branches) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($branches as $branch)
                <div class="card-nexus rounded-2xl overflow-hidden flex flex-col justify-between">
                    <div class="h-44 overflow-hidden relative">
                        <img src="{{ $branch['thumbnail_url'] }}" alt="{{ $branch['name'] }}" class="h-full w-full object-cover">
                        <span class="absolute top-3 right-3 rounded-full bg-white/90 backdrop-blur-xs px-3 py-1 text-xs font-bold text-[#001b79]">
                            {{ $branch['sektor'] ?? 'Wilayah' }}
                        </span>
                    </div>
                    <div class="p-6 space-y-3">
                        <h3 class="text-lg font-bold text-[#000c46]">{{ $branch['name'] }}</h3>
                        <p class="text-xs font-medium text-[#454652] flex items-center gap-1">
                            <svg class="h-4 w-4 text-[#0453cd]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                            {{ $branch['location'] }}
                        </p>
                        <div class="pt-2 border-t border-slate-100 flex items-center justify-between">
                            <a href="{{ route('branch.show', $branch['id']) }}" class="text-sm font-bold text-[#0453cd] hover:underline">
                                Lihat Detail &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <x-common.empty-state title="Belum Ada Cabang" message="Data cabang HIMSI akan segera diperbarui." />
    @endif
</section>
