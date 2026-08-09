@props(['divisions'])

<section class="space-y-10">
    <x-common.section-header 
        badge="Divisi"
        title="Daftar Divisi Organisasi" 
        subtitle="Divisi pendukung utama operasional dan program kerja Himpunan Mahasiswa Sistem Informasi" />

    @if (count($divisions) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 lg:gap-8">
            @foreach ($divisions as $division)
                <div class="group rounded-2xl bg-white p-7 sm:p-8 border border-[#c5c5d4]/60 shadow-[0_4px_20px_rgba(0,27,121,0.04)] hover:shadow-[0_12px_32px_rgba(0,27,121,0.12)] hover:border-[#0453cd]/40 transition-all duration-300 flex flex-col justify-between space-y-6">
                    
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="h-12 w-12 rounded-2xl bg-[#001b79]/5 p-2.5 flex items-center justify-center text-[#0453cd] group-hover:bg-[#001b79] group-hover:text-white transition-all duration-300 shadow-xs">
                                @if (isset($division['logo_url']) && $division['logo_url'] !== '/images/placeholder.svg')
                                    <img src="{{ $division['logo_url'] }}" alt="{{ $division['name'] }}" loading="lazy" class="h-full w-full object-contain">
                                @else
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                @endif
                            </div>
                            @if (isset($division['is_dpp']) && $division['is_dpp'])
                                <span class="rounded-full bg-[#000c46] px-3 py-1 text-xs font-bold text-white uppercase tracking-wider shadow-xs">
                                    DPP
                                </span>
                            @endif
                        </div>

                        <div class="space-y-2">
                            <h3 class="text-xl font-bold text-[#000c46] group-hover:text-[#0453cd] transition-colors">
                                {{ $division['name'] }}
                            </h3>
                            <p class="text-sm text-[#454652] leading-relaxed line-clamp-3">
                                {{ \Illuminate\Support\Str::limit(strip_tags($division['description']), 150) }}
                            </p>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                        <a href="{{ route('division.show', $division['id']) }}" class="inline-flex items-center gap-2 text-sm font-bold text-[#0453cd] group-hover:text-[#001b79] transition-colors">
                            <span>Detail Divisi & Tasks</span>
                            <svg class="w-4 h-4 group-hover:translate-x-1.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                            </svg>
                        </a>
                    </div>

                </div>
            @endforeach
        </div>
    @endif
</section>
