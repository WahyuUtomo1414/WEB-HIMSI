@props(['divisions'])

<section class="w-full py-12 sm:py-16 lg:py-20 bg-white border-b border-[#c5c5d4]/40" x-data="{ activeTab: 0 }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        @if (count($divisions) > 0)
            <!-- Section Header -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10 lg:mb-12">
                <x-common.section-header badge="Fokus & Peran Organisasi" title="Struktur & Profil Divisi HIMSI UBSI"
                    subtitle="Mengenal peran strategis, tugas pokok, dan kontribusi nyata tiap divisi Himpunan Mahasiswa Sistem Informasi UBSI dalam mewujudkan inovasi dan keunggulan akademik."
                    align="left" />

                <div class="hidden sm:block shrink-0">
                    <a href="{{ route('about.index') }}"
                        class="inline-flex items-center gap-2 rounded-xl bg-[#f0f4ff] px-5 py-3 text-sm font-bold text-[#001b79] transition-all hover:bg-[#001b79] hover:text-white group border border-[#c5c5d4]/40">
                        <span>Lihat Semua Profil</span>
                        <svg class="h-4 w-4 group-hover:translate-x-1 transition-transform" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Horizontal Interactive Tabs Menu -->
            <div
                class="no-scrollbar flex items-center gap-2 overflow-x-auto border-b border-[#c5c5d4]/60 pb-3 mb-8 lg:mb-10">
                @foreach ($divisions as $index => $division)
                    <button @click="activeTab = {{ $index }}" type="button"
                        :class="activeTab === {{ $index }} ?
                            'bg-[#001b79] text-white shadow-md border-[#001b79]' :
                            'bg-[#f0f4ff] text-[#454652] hover:bg-white hover:text-[#000c46] border-[#c5c5d4]/60'"
                        class="inline-flex items-center gap-2.5 whitespace-nowrap rounded-xl px-5 py-3 text-sm font-bold border transition-all duration-200">

                        <!-- Mini Icon / Indicator -->
                        <span class="h-2 w-2 rounded-full"
                            :class="activeTab === {{ $index }} ? 'bg-[#f59e0b]' : 'bg-slate-300'"></span>

                        <span>{{ $division['name'] }}</span>

                        @if (!empty($division['is_dpp']))
                            <span
                                :class="activeTab === {{ $index }} ? 'bg-white/20 text-white' :
                                    'bg-slate-200 text-slate-700'"
                                class="rounded-md px-1.5 py-0.5 text-[10px] font-extrabold uppercase">DPP</span>
                        @endif
                    </button>
                @endforeach
            </div>

            <!-- Tab Panels Showcase -->
            <div>
                @foreach ($divisions as $index => $division)
                    <div x-show="activeTab === {{ $index }}"
                        x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="opacity-0 translate-y-3 scale-98"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        class="rounded-3xl border border-[#c5c5d4]/60 bg-[#f9f9fc] p-6 sm:p-8 lg:p-12 shadow-[0_8px_30px_rgba(0,27,121,0.06)]">

                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">

                            <!-- Left Details Column -->
                            <div class="lg:col-span-7 space-y-6">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="h-12 w-12 rounded-xl bg-white p-2.5 border border-[#c5c5d4]/50 shadow-sm flex items-center justify-center">
                                        @if (isset($division['logo_url']) && $division['logo_url'] !== '/images/placeholder.svg')
                                            <img src="{{ $division['logo_url'] }}" alt="{{ $division['name'] }}"
                                                class="h-full w-full object-contain">
                                        @else
                                            <svg class="w-6 h-6 text-[#001b79]" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div>
                                        <span
                                            class="text-xs font-extrabold uppercase tracking-wider text-[#0453cd]">Divisi
                                            Organisasi</span>
                                        <h3 class="text-2xl sm:text-3xl font-extrabold text-[#000c46]">
                                            {{ $division['name'] }}
                                        </h3>
                                    </div>
                                </div>

                                <p class="text-base text-[#454652] leading-relaxed font-normal">
                                    {{ $division['description'] }}
                                </p>

                                <!-- Job Description Bullet List -->
                                <div class="space-y-3 pt-2">
                                    <h4 class="text-xs font-extrabold text-[#000c46] uppercase tracking-wider">
                                        Tugas & Tanggung Jawab Utama:
                                    </h4>

                                    @if (!empty($division['job_description']) && is_array($division['job_description']))
                                        <div class="grid grid-cols-1 gap-3">
                                            @foreach ($division['job_description'] as $job)
                                                <div
                                                    class="flex items-start gap-3 text-sm text-[#454652] bg-white p-3.5 rounded-xl border border-[#c5c5d4]/40 shadow-xs">
                                                    <svg class="h-5 w-5 text-[#f59e0b] shrink-0 mt-0.5" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <span class="font-medium leading-relaxed">{{ $job }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="grid grid-cols-1 gap-3">
                                            <div
                                                class="flex items-start gap-3 text-sm text-[#454652] bg-white p-3.5 rounded-xl border border-[#c5c5d4]/40">
                                                <svg class="h-5 w-5 text-[#0453cd] shrink-0 mt-0.5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span class="font-medium leading-relaxed">Perencanaan & Eksekusi Program Kerja Divisi</span>
                                            </div>
                                            <div
                                                class="flex items-start gap-3 text-sm text-[#454652] bg-white p-3.5 rounded-xl border border-[#c5c5d4]/40">
                                                <svg class="h-5 w-5 text-[#0453cd] shrink-0 mt-0.5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span class="font-medium leading-relaxed">Pengembangan Inovasi & Kapasitas Anggota</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- Action CTA -->
                                <div class="pt-4 flex items-center gap-4">
                                    <a href="{{ route('division.show', $division['id']) }}"
                                        class="inline-flex items-center justify-center rounded-xl bg-[#001b79] px-6 py-3.5 text-sm font-bold text-white transition-all hover:bg-[#000c46] hover:shadow-lg shadow-md group">
                                        <span>Lihat Profil {{ $division['name'] }}</span>
                                        <svg class="ml-2 h-4 w-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <!-- Right Visual Image Showcase -->
                            <div class="lg:col-span-5 relative">
                                <div
                                    class="relative w-full overflow-hidden rounded-2xl border-2 border-white shadow-xl aspect-[4/3] bg-[#000c46]">
                                    @if (isset($division['image_url']) && $division['image_url'] !== '/images/placeholder.jpg')
                                        <img src="{{ $division['image_url'] }}" alt="{{ $division['name'] }}"
                                            class="h-full w-full object-cover opacity-95 transition-transform duration-500 hover:scale-105">
                                    @else
                                        <!-- Fallback Artistic Graphic -->
                                        <div
                                            class="absolute inset-0 flex flex-col items-center justify-center p-6 text-center text-white space-y-3 bg-[radial-gradient(#356ee7_1px,transparent_1px)] [background-size:16px_16px]">
                                            <div
                                                class="h-16 w-16 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center border border-white/20">
                                                <svg class="h-8 w-8 text-[#f59e0b]" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                                </svg>
                                            </div>
                                            <span
                                                class="text-xl font-bold tracking-wide">{{ $division['name'] }}</span>
                                            <span class="text-xs text-white/70">HIMSI UBSI Division Spotlight</span>
                                        </div>
                                    @endif

                                    <!-- Bottom Gradient Overlay -->
                                    <div
                                        class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-[#000c46]/90 via-[#000c46]/40 to-transparent p-4 text-white flex items-center justify-between">
                                        <span class="text-xs font-bold text-white/90 uppercase tracking-wider">HIMSI UBSI Profile</span>
                                    </div>
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
