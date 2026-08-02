@props(['branches', 'sektors', 'currentSearch', 'currentSektor', 'currentType'])

<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12 space-y-8">
    
    {{-- Search & Filter Bar --}}
    <div class="card-nexus rounded-2xl p-6 bg-white space-y-4">
        <form method="GET" action="{{ route('branch.index') }}" class="grid grid-cols-1 md:grid-cols-12 gap-4">
            {{-- Search Input --}}
            <div class="md:col-span-6 relative">
                <input type="text" 
                       name="search" 
                       value="{{ $currentSearch }}" 
                       placeholder="Cari nama cabang, lokasi, atau sektor..." 
                       class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 pl-10 text-sm focus:border-[#001b79] focus:bg-white focus:outline-none">
                <svg class="absolute left-3 top-3.5 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>

            {{-- Type Filter (DPP/DPC) --}}
            <div class="md:col-span-3">
                <select name="type" onchange="this.form.submit()" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-[#001b79] focus:bg-white focus:outline-none">
                    <option value="">Semua Tingkat (DPP & DPC)</option>
                    <option value="dpp" {{ $currentType === 'dpp' ? 'selected' : '' }}>Dewan Pimpinan Pusat (DPP)</option>
                    <option value="dpc" {{ $currentType === 'dpc' ? 'selected' : '' }}>Dewan Pimpinan Cabang (DPC)</option>
                </select>
            </div>

            {{-- Sektor Filter --}}
            <div class="md:col-span-3">
                <select name="sektor" onchange="this.form.submit()" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-[#001b79] focus:bg-white focus:outline-none">
                    <option value="">Semua Sektor Wilayah</option>
                    @foreach ($sektors as $sektor)
                        <option value="{{ $sektor }}" {{ $currentSektor === $sektor ? 'selected' : '' }}>{{ $sektor }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>

    {{-- Grid Cabang List --}}
    @if (count($branches) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($branches as $branch)
                <div class="card-nexus rounded-2xl overflow-hidden flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="h-48 overflow-hidden relative">
                            <img src="{{ $branch['thumbnail_url'] }}" alt="{{ $branch['name'] }}" class="h-full w-full object-cover">
                            <div class="absolute top-3 right-3 flex gap-2">
                                @if ($branch['is_dpp'])
                                    <span class="rounded-full bg-[#000c46] px-3 py-1 text-xs font-bold text-white shadow-sm">DPP</span>
                                @endif
                                <span class="rounded-full bg-white/90 backdrop-blur-xs px-3 py-1 text-xs font-bold text-[#001b79]">
                                    {{ $branch['sektor'] ?? 'Wilayah' }}
                                </span>
                            </div>
                        </div>
                        <div class="p-6 space-y-3">
                            <h3 class="text-xl font-bold text-[#000c46]">{{ $branch['name'] }}</h3>
                            <p class="text-xs font-semibold text-[#0453cd] flex items-center gap-1.5">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                                {{ $branch['location'] }}
                            </p>
                            <p class="text-sm text-[#454652] line-clamp-3 leading-relaxed">
                                {{ $branch['description'] }}
                            </p>
                        </div>
                    </div>
                    <div class="p-6 pt-0 border-t border-slate-100 flex items-center justify-between">
                        <a href="{{ route('branch.show', $branch['id']) }}" class="text-sm font-bold text-[#0453cd] hover:underline">
                            Lihat Profil Cabang &rarr;
                        </a>
                        @if ($branch['grup_wa'])
                            <a href="{{ $branch['grup_wa'] }}" target="_blank" rel="noopener" class="text-xs font-semibold text-emerald-600 hover:text-emerald-700">
                                Grup WA
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <x-common.empty-state title="Cabang Tidak Ditemukan" message="Tidak ada data cabang yang sesuai dengan pencarian/filter Anda." />
    @endif

</div>
