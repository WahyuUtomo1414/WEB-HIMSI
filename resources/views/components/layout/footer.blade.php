<footer class="bg-[#000c46] text-white pt-16 pb-12 border-t border-[#001b79] relative overflow-hidden isolate">
    @php
        $footerOrganization = $globalOrganization ?? null;
        $footerDivisions = $globalDivisions ?? collect();
    @endphp

    <!-- Background Radial Accent Glows -->
    <div class="absolute -left-20 -top-20 h-72 w-72 rounded-full bg-[#0453cd]/20 blur-3xl -z-10 pointer-events-none">
    </div>
    <div class="absolute -right-20 -bottom-20 h-72 w-72 rounded-full bg-amber-500/10 blur-3xl -z-10 pointer-events-none">
    </div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-10 md:grid-cols-2 lg:grid-cols-12 pb-14 border-b border-white/10">

            {{-- Col 1: Brand (lg:col-span-4) --}}
            <div class="lg:col-span-4 space-y-5">
                <div class="flex items-center gap-4">
                    <!-- Bigger Logo Container -->
                    <div
                        class="h-16 w-16 sm:h-20 sm:w-20 rounded-2xl bg-white p-1 flex items-center justify-center shadow-xl border-2 border-white/30 shrink-0">
                        <img src="{{ asset('images/himsi.png') }}" alt="Logo HIMSI UBSI"
                            loading="lazy"
                            class="h-full w-full object-contain">
                    </div>
                    <div class="space-y-0.5">
                        <span
                            class="text-2xl font-black text-white tracking-tight block leading-tight">{{ $footerOrganization?->kode_org ?? 'HIMSI UBSI' }}</span>
                        <span
                            class="text-xs font-semibold text-slate-300 tracking-tight block">{{ $footerOrganization?->name ?? 'Himpunan Mahasiswa Sistem Informasi' }}</span>
                    </div>
                </div>
                <p class="text-sm text-slate-300 leading-relaxed max-w-sm">
                    Himpunan Mahasiswa Sistem Informasi Universitas Bina Sarana Informatika. Wadah pengembangan
                    akademik, inovasi teknologi, dan pengabdian mahasiswa.
                </p>
                <div class="pt-2">
                    <x-common.social-icons :socials="$footerOrganization?->sosial_media" variant="footer" size="md" />
                </div>
            </div>

            {{-- Col 2: Navigasi Utama (lg:col-span-3) --}}
            <div class="lg:col-span-3 space-y-4">
                <h4 class="text-base font-bold text-white tracking-wide border-l-4 border-amber-400 pl-3">
                    Navigasi Utama
                </h4>
                <ul class="space-y-2.5 text-sm text-slate-200">
                    <li>
                        <a href="{{ route('home') }}"
                            class="{{ request()->routeIs('home') ? 'text-amber-400 font-bold' : 'hover:text-amber-400' }} hover:translate-x-1 inline-flex items-center gap-1.5 transition-all">
                            <span>&rsaquo;</span> Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about.index') }}"
                            class="{{ request()->routeIs('about.index') ? 'text-amber-400 font-bold' : 'hover:text-amber-400' }} hover:translate-x-1 inline-flex items-center gap-1.5 transition-all">
                            <span>&rsaquo;</span> Tentang Kami
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('branch.index') }}"
                            class="{{ request()->routeIs('branch.*') ? 'text-amber-400 font-bold' : 'hover:text-amber-400' }} hover:translate-x-1 inline-flex items-center gap-1.5 transition-all">
                            <span>&rsaquo;</span> Kepengurusan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('blog.index') }}"
                            class="{{ request()->routeIs('blog.*') ? 'text-amber-400 font-bold' : 'hover:text-amber-400' }} hover:translate-x-1 inline-flex items-center gap-1.5 transition-all">
                            <span>&rsaquo;</span> Blog & Artikel
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('ai.index') }}"
                            class="{{ request()->routeIs('ai.*') ? 'text-amber-400 font-bold' : 'hover:text-amber-400' }} hover:translate-x-1 inline-flex items-center gap-1.5 transition-all">
                            <span>&rsaquo;</span> Asisten AI HIMSI
                            <span class="text-[9px] uppercase tracking-wider bg-blue-600 text-white font-black px-1.5 py-0.5 rounded-md ml-1">AI</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact.index') }}"
                            class="{{ request()->routeIs('contact.index') ? 'text-amber-400 font-bold' : 'hover:text-amber-400' }} hover:translate-x-1 inline-flex items-center gap-1.5 transition-all">
                            <span>&rsaquo;</span> Kontak Resmi
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Col 3: Divisi (lg:col-span-2) --}}
            <div class="lg:col-span-2 space-y-4">
                <h4 class="text-base font-bold text-white tracking-wide border-l-4 border-amber-400 pl-3">
                    Divisi
                </h4>
                <ul class="space-y-2.5 text-sm text-slate-200">
                    @forelse ($footerDivisions as $division)
                        <li>
                            <a href="{{ route('division.show', $division) }}"
                                class="hover:text-amber-400 hover:translate-x-1 inline-flex items-center gap-1.5 transition-all">
                                <span>&rsaquo;</span> {{ $division->name }}
                            </a>
                        </li>
                    @empty
                        <li>
                            <span class="text-slate-400">Data divisi belum tersedia</span>
                        </li>
                    @endforelse
                </ul>
            </div>

            {{-- Col 4: Hubungi Kami (lg:col-span-3) --}}
            <div class="lg:col-span-3 space-y-4">
                <h4 class="text-base font-bold text-white tracking-wide border-l-4 border-amber-400 pl-3">
                    Hubungi Kami
                </h4>
                <div class="space-y-4 text-sm text-slate-200">
                    <!-- Card Sekretariat -->
                    <div
                        class="flex items-center gap-3.5 p-4.5 sm:p-5 rounded-2xl bg-white/10 border border-white/15 hover:border-amber-400/40 transition-all shadow-md">
                        <div
                            class="h-11 w-11 rounded-xl bg-amber-400/20 text-amber-300 flex items-center justify-center shrink-0 border border-amber-400/30">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div class="space-y-1 min-w-0">
                            <span
                                class="text-[11px] font-bold text-amber-300 uppercase tracking-wider block">Sekretariat</span>
                            <span
                                class="text-xs sm:text-sm text-white font-semibold block leading-snug">{{ $footerOrganization?->address ?? 'Alamat belum tersedia' }}</span>
                        </div>
                    </div>

                    <!-- Card Email Resmi -->
                    <div
                        class="flex items-center gap-3.5 p-4.5 sm:p-5 rounded-2xl bg-white/10 border border-white/15 hover:border-amber-400/40 transition-all shadow-md">
                        <div
                            class="h-11 w-11 rounded-xl bg-amber-400/20 text-amber-300 flex items-center justify-center shrink-0 border border-amber-400/30">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="space-y-1 min-w-0">
                            <span class="text-[11px] font-bold text-amber-300 uppercase tracking-wider block">Email
                                Resmi</span>
                            <a href="mailto:{{ $footerOrganization?->email ?? 'info@himsi.org' }}"
                                class="text-xs sm:text-sm text-amber-300 font-bold hover:text-amber-200 hover:underline block leading-snug truncate">{{ $footerOrganization?->email ?? 'info@himsi.org' }}</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Bottom Copyright & Developer Credit --}}
        <div class="pt-8 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 text-xs text-slate-300">
            <!-- Left Side: Developer Credit (Top) + Copyright (Bottom) -->
            <div class="space-y-1">
                <div class="flex items-center gap-1.5 text-slate-300 font-medium">
                    <span>Dikembangkan oleh</span>
                    <span class="text-amber-400 font-bold">Divisi Pendidikan</span>
                </div>
                <p>&copy; {{ date('Y') }} {{ $footerOrganization?->kode_org ?? 'HIMSI UBSI' }}. All rights reserved.</p>
            </div>

            <!-- Right Side: Full Organization Name -->
            <p class="text-slate-200 font-medium sm:text-right">
                {{ $footerOrganization?->name ?? 'Himpunan Mahasiswa Sistem Informasi - Universitas Bina Sarana Informatika' }}
            </p>
        </div>
    </div>
</footer>
