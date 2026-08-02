@props(['milestones'])

<section class="space-y-10">
    <x-common.section-header 
        badge="Linimasa"
        title="Milestone & Sejarah" 
        subtitle="Jejak langkah dan pencapaian perjalanan pergerakan HIMSI dari waktu ke waktu" />

    @if (count($milestones) > 0)
        <div class="max-w-4xl mx-auto space-y-8 relative before:absolute before:inset-0 before:left-4 md:before:left-1/2 before:w-0.5 before:bg-[#c5c5d4]">
            @foreach ($milestones as $index => $milestone)
                <div class="relative flex flex-col md:flex-row items-start md:items-center gap-6 group">
                    <div class="flex items-center justify-center h-10 w-10 rounded-full bg-[#001b79] text-white font-extrabold text-xs shadow-md z-10 shrink-0 border-4 border-white md:mx-auto">
                        {{ $milestone['year'] }}
                    </div>
                    <div class="w-full md:w-1/2 {{ $index % 2 === 0 ? 'md:pr-10 md:text-right' : 'md:pl-10 md:ml-auto' }}">
                        <div class="card-nexus rounded-2xl p-6 space-y-2">
                            <span class="text-xs font-bold text-[#0453cd]">Tahun {{ $milestone['year'] }}</span>
                            <ul class="space-y-1.5 text-sm text-[#454652]">
                                @foreach ($milestone['list'] as $item)
                                    <li>{{ is_array($item) ? ($item['value'] ?? implode(', ', $item)) : $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <x-common.empty-state title="Belum Ada Milestone" message="Data linimasa sejarah organisasi akan segera ditambahkan." />
    @endif
</section>
