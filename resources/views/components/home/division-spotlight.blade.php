@props(['divisions'])

<section class="w-full py-12 sm:py-16 lg:py-20 bg-white border-b border-[#c5c5d4]/40" x-data="{ activeTab: 0 }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        @if (count($divisions) > 0)
            <!-- Section Header -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10 lg:mb-12">
                <x-common.section-header
                    badge="Fokus & Peran Organisasi"
                    title="Struktur & Profil Divisi HIMSI UBSI"
                    subtitle="Mengenal peran strategis, tugas pokok, dan kontribusi nyata tiap divisi dalam mewujudkan inovasi dan keunggulan akademik."
                    align="left" />

                <div class="hidden sm:block shrink-0">
                    <a href="{{ route('about.index') }}"
                        class="inline-flex items-center gap-2 rounded-xl bg-[#f0f4ff] px-5 py-3 text-sm font-bold text-[#001b79] transition-all hover:bg-[#001b79] hover:text-white group border border-[#c5c5d4]/40">
                        <span>Lihat Semua Profil</span>
                        <svg class="h-4 w-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Tab Navigation -->
            <div class="no-scrollbar flex items-center gap-2 overflow-x-auto pb-0 mb-6">
                @foreach ($divisions as $index => $division)
                    <button
                        @click="activeTab = {{ $index }}"
                        type="button"
                        :class="activeTab === {{ $index }}
                            ? 'text-[#001b79] font-extrabold border-b-2 border-[#001b79]'
                            : 'text-[#757683] font-semibold border-b-2 border-transparent hover:text-[#000c46] hover:border-[#c5c5d4]'"
                        class="inline-flex items-center gap-2 whitespace-nowrap px-4 py-3 text-sm transition-all duration-200 focus:outline-none">

                        <span class="h-1.5 w-1.5 rounded-full transition-colors"
                            :class="activeTab === {{ $index }} ? 'bg-[#f59e0b]' : 'bg-[#c5c5d4]'"></span>

                        <span>{{ $division['name'] }}</span>

                        @if (!empty($division['is_dpp']))
                            <span class="rounded px-1.5 py-0.5 text-[9px] font-black uppercase tracking-wider"
                                :class="activeTab === {{ $index }} ? 'bg-[#f0f4ff] text-[#001b79]' : 'bg-slate-100 text-slate-500'">
                                DPP
                            </span>
                        @endif
                    </button>
                @endforeach
            </div>

            <!-- Thin Separator -->
            <div class="w-full h-px bg-[#c5c5d4]/50 mb-8 lg:mb-10"></div>

            <!-- Tab Panels -->
            <div>
                @foreach ($divisions as $index => $division)
                    @php
                        $descriptionText = $division['description'] ?? '';
                        $isTruncated = strlen($descriptionText) > 150;
                        $shortDescription = $isTruncated ? Str::limit($descriptionText, 150) : $descriptionText;

                        $jobItems = collect($division['job_description'] ?? [])
                            ->map(fn($job) => is_array($job) ? ($job['value'] ?? '') : (string) $job)
                            ->filter()
                            ->take(6)
                            ->values();
                    @endphp

                    <div x-show="activeTab === {{ $index }}"
                        x-transition:enter="transition ease-out duration-250"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-data="{ jobExpanded: false }"
                        class="rounded-2xl border border-[#c5c5d4]/60 bg-[#f9f9fc] overflow-hidden shadow-[0_4px_24px_rgba(0,27,121,0.06)]">

                        <div class="grid grid-cols-1 lg:grid-cols-12">

                            <!-- Left Content -->
                            <div class="lg:col-span-7 p-6 sm:p-8 lg:p-10 space-y-6">

                                <!-- Identity -->
                                <div class="flex items-start gap-4">
                                    <div class="shrink-0 h-14 w-14 rounded-2xl bg-white border border-[#c5c5d4]/60 shadow-sm flex items-center justify-center">
                                        @if (!empty($division['logo_url']) && !str_contains($division['logo_url'], 'placeholder'))
                                            <img src="{{ $division['logo_url'] }}" alt="{{ $division['name'] }}" class="h-9 w-9 object-contain">
                                        @else
                                            <svg class="w-7 h-7 text-[#001b79]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <span class="inline-block text-[10px] font-extrabold uppercase tracking-widest text-[#0453cd] mb-1">Divisi Organisasi</span>
                                        <h3 class="text-xl sm:text-2xl lg:text-3xl font-extrabold text-[#000c46] leading-tight">
                                            {{ $division['name'] }}
                                        </h3>
                                        @if ($jobItems->count() > 0)
                                            <span class="inline-flex items-center gap-1 mt-2 text-[11px] font-semibold text-[#454652] bg-white border border-[#c5c5d4]/60 rounded-full px-2.5 py-0.5">
                                                <svg class="h-3 w-3 text-[#f59e0b]" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2v1a1 1 0 102 0V3h4v1a1 1 0 102 0V3a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                                                </svg>
                                                {{ $jobItems->count() }} tugas pokok
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="space-y-2">
                                    <p class="text-sm sm:text-base text-[#454652] leading-relaxed">
                                        {{ $shortDescription }}
                                    </p>
                                    @if ($isTruncated)
                                        <a href="{{ route('division.show', $division['id']) }}"
                                            class="inline-flex items-center gap-1 text-sm font-semibold text-[#0453cd] hover:text-[#001b79] transition-colors group">
                                            Selengkapnya
                                            <svg class="h-3.5 w-3.5 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                            </svg>
                                        </a>
                                    @endif
                                </div>

                                <!-- Job Descriptions -->
                                @if ($jobItems->count() > 0)
                                    @php
                                        $visibleJobs = $jobItems->take(4);
                                        $hiddenJobs  = $jobItems->slice(4);
                                        $hasMore     = $hiddenJobs->count() > 0;
                                    @endphp
                                    <div class="space-y-3">
                                        <h4 class="text-[11px] font-extrabold text-[#000c46] uppercase tracking-widest flex items-center gap-2">
                                            <span class="h-px flex-1 bg-[#c5c5d4]/60"></span>
                                            Tugas & Tanggung Jawab
                                            <span class="h-px flex-1 bg-[#c5c5d4]/60"></span>
                                        </h4>

                                        {{-- 4 item pertama selalu tampil --}}
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                            @foreach ($visibleJobs as $job)
                                                <div class="flex items-start gap-2.5 bg-white rounded-xl border border-[#c5c5d4]/50 px-3.5 py-3">
                                                    <svg class="h-4 w-4 text-[#f59e0b] shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    <span class="text-sm text-[#454652] font-medium leading-snug">{{ $job }}</span>
                                                </div>
                                            @endforeach
                                        </div>

                                        {{-- item selebihnya, hidden by default --}}
                                        @if ($hasMore)
                                            <div x-show="jobExpanded"
                                                x-transition:enter="transition ease-out duration-200"
                                                x-transition:enter-start="opacity-0 -translate-y-1"
                                                x-transition:enter-end="opacity-100 translate-y-0"
                                                class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                                @foreach ($hiddenJobs as $job)
                                                    <div class="flex items-start gap-2.5 bg-white rounded-xl border border-[#c5c5d4]/50 px-3.5 py-3">
                                                        <svg class="h-4 w-4 text-[#f59e0b] shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                        <span class="text-sm text-[#454652] font-medium leading-snug">{{ $job }}</span>
                                                    </div>
                                                @endforeach
                                            </div>

                                            {{-- toggle button --}}
                                            <button
                                                @click="jobExpanded = !jobExpanded"
                                                type="button"
                                                class="inline-flex items-center gap-1.5 text-xs font-bold text-[#0453cd] hover:text-[#001b79] transition-colors group">
                                                <span x-text="jobExpanded ? 'Sembunyikan' : 'Lihat {{ $hiddenJobs->count() }} tugas lainnya'"></span>
                                                <svg class="h-3.5 w-3.5 transition-transform duration-200"
                                                    :class="jobExpanded ? 'rotate-180' : 'rotate-0'"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                @else
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                        @foreach (['Perencanaan & Eksekusi Program Kerja', 'Pengembangan Inovasi & Kapasitas Anggota'] as $fallback)
                                            <div class="flex items-start gap-2.5 bg-white rounded-xl border border-[#c5c5d4]/50 px-3.5 py-3">
                                                <svg class="h-4 w-4 text-[#0453cd] shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                <span class="text-sm text-[#454652] font-medium leading-snug">{{ $fallback }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <!-- CTA -->
                                <div class="pt-2">
                                    <a href="{{ route('division.show', $division['id']) }}"
                                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#001b79] px-5 py-3 text-sm font-bold text-white transition-all hover:bg-[#000c46] hover:shadow-lg shadow-md group">
                                        <span>Lihat Profil Lengkap</span>
                                        <svg class="h-4 w-4 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <!-- Right Image -->
                            <div class="lg:col-span-5 relative min-h-[260px] lg:min-h-0 bg-[#000c46] overflow-hidden">
                                @if (!empty($division['image_url']) && !str_contains($division['image_url'], 'placeholder'))
                                    <img src="{{ $division['image_url'] }}" alt="{{ $division['name'] }}"
                                        class="absolute inset-0 h-full w-full object-cover opacity-80 transition-transform duration-700 hover:scale-105">
                                @else
                                    <div class="absolute inset-0 flex items-center justify-center bg-[radial-gradient(#356ee7_1px,transparent_1px)] [background-size:18px_18px]">
                                        <div class="text-center text-white space-y-3 p-8">
                                            <div class="mx-auto h-16 w-16 rounded-2xl bg-white/10 backdrop-blur border border-white/20 flex items-center justify-center">
                                                <svg class="h-8 w-8 text-[#f59e0b]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/>
                                                </svg>
                                            </div>
                                            <p class="text-base font-bold tracking-wide">{{ $division['name'] }}</p>
                                            <p class="text-xs text-white/60 font-medium">HIMSI UBSI</p>
                                        </div>
                                    </div>
                                @endif

                                <!-- Gradient overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-[#000c46]/70 via-transparent to-transparent pointer-events-none"></div>

                                <!-- Bottom label -->
                                <div class="absolute bottom-0 inset-x-0 p-4 flex items-end justify-between">
                                    <div>
                                        <p class="text-[10px] text-white/60 font-semibold uppercase tracking-widest">Divisi</p>
                                        <p class="text-sm font-extrabold text-white leading-tight">{{ $division['name'] }}</p>
                                    </div>
                                    @if (!empty($division['is_dpp']))
                                        <span class="text-[9px] font-black uppercase tracking-wider bg-[#f59e0b] text-slate-900 rounded px-2 py-1">DPP</span>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

        @else
            <x-common.empty-state title="Belum Ada Divisi" message="Data divisi organisasi akan segera diperbarui." />
        @endif

    </div>
</section>
