@props(['branches', 'sektors', 'currentSearch', 'currentSektor', 'currentType'])

<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12 space-y-10">
    
    {{-- Search & Filter Bar --}}
    <div class="rounded-2xl p-6 bg-white border border-[#c5c5d4]/60 shadow-[0_4px_20px_rgba(0,27,121,0.04)] space-y-4">
        <form method="GET" action="{{ route('branch.index') }}" class="grid grid-cols-1 md:grid-cols-12 gap-4">
            {{-- Search Input --}}
            <div class="md:col-span-6 relative">
                <input type="text" 
                       name="search" 
                       value="{{ $currentSearch }}" 
                       placeholder="Cari nama cabang, lokasi, atau sektor..." 
                       class="w-full rounded-xl border border-[#c5c5d4]/60 bg-[#f0f4ff]/50 px-4 py-3 pl-10 text-sm text-[#000c46] placeholder:text-slate-400 focus:border-[#0453cd] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0453cd]/20 transition-all">
                <svg class="absolute left-3.5 top-3.5 h-4 w-4 text-[#0453cd]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>

            {{-- Type Filter (DPP/DPC) --}}
            <div class="md:col-span-3">
                <select name="type" onchange="this.form.submit()" class="w-full rounded-xl border border-[#c5c5d4]/60 bg-[#f0f4ff]/50 px-4 py-3 text-sm text-[#000c46] focus:border-[#0453cd] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0453cd]/20 transition-all cursor-pointer">
                    <option value="">Semua Tingkat (DPP & DPC)</option>
                    <option value="dpp" {{ $currentType === 'dpp' ? 'selected' : '' }}>Dewan Pimpinan Pusat (DPP)</option>
                    <option value="dpc" {{ $currentType === 'dpc' ? 'selected' : '' }}>Dewan Pimpinan Cabang (DPC)</option>
                </select>
            </div>

            {{-- Sektor Filter --}}
            <div class="md:col-span-3">
                <select name="sektor" onchange="this.form.submit()" class="w-full rounded-xl border border-[#c5c5d4]/60 bg-[#f0f4ff]/50 px-4 py-3 text-sm text-[#000c46] focus:border-[#0453cd] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0453cd]/20 transition-all cursor-pointer">
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
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            @foreach ($branches as $branch)
                <div class="group rounded-2xl bg-white border border-[#c5c5d4]/60 shadow-[0_4px_16px_rgba(0,27,121,0.04)] hover:shadow-[0_12px_32px_rgba(0,27,121,0.12)] hover:border-[#0453cd]/40 transition-all duration-300 overflow-hidden flex flex-col justify-between">
                    
                    <div class="space-y-4">
                        <!-- Thumbnail Container (Taller height) -->
                        <div class="h-64 sm:h-72 lg:h-80 overflow-hidden relative bg-[#f0f4ff]/70 flex items-center justify-center p-4 border-b border-[#c5c5d4]/40">
                            <x-common.image :src="$branch['thumbnail_url']" :alt="$branch['name']" class="h-full w-full object-contain group-hover:scale-105 transition-all duration-500" />
                            
                            <div class="absolute top-4 right-4 flex items-center gap-1.5 z-10">
                                @if ($branch['is_dpp'])
                                    <span class="rounded-full bg-[#000c46] px-3 py-1 text-xs font-bold text-white uppercase tracking-wider shadow-xs">DPP</span>
                                @endif
                                <span class="rounded-full bg-white border border-[#c5c5d4]/50 px-3.5 py-1 text-xs font-bold text-[#001b79] shadow-xs">
                                    {{ $branch['sektor'] ?? 'Wilayah' }}
                                </span>
                            </div>
                        </div>

                        <!-- Info Content -->
                        <div class="p-6 space-y-3">
                            <h3 class="text-xl font-bold text-[#000c46] group-hover:text-[#0453cd] transition-colors leading-snug">
                                {{ $branch['name'] }}
                            </h3>
                            <p class="text-xs font-semibold text-[#454652] flex items-center gap-2">
                                <svg class="h-4.5 w-4.5 text-[#0453cd] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span>{{ $branch['location'] }}</span>
                            </p>
                            @if (isset($branch['description']))
                                <p class="text-sm text-[#454652] line-clamp-3 leading-relaxed">
                                    {{ $branch['description'] }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Footer Link -->
                    <div class="p-6 pt-0">
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                            <a href="{{ route('branch.show', $branch['id']) }}" class="inline-flex items-center gap-2 text-sm font-bold text-[#0453cd] group-hover:text-[#001b79] transition-colors">
                                <span>Lihat Profil Cabang</span>
                                <svg class="w-4 h-4 group-hover:translate-x-1.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                                </svg>
                            </a>
                            @if (!empty($branch['grup_wa']))
                                <a href="{{ $branch['grup_wa'] }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1 text-xs font-bold text-emerald-600 bg-emerald-50 border border-emerald-200 px-3 py-1 rounded-full hover:bg-emerald-600 hover:text-white transition-all shadow-xs">
                                    <span>Grup WA</span>
                                </a>
                            @endif
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    @else
        <x-common.empty-state title="Cabang Tidak Ditemukan" message="Tidak ada data cabang yang sesuai dengan pencarian/filter Anda." />
    @endif

</div>
