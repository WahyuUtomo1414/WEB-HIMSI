<section class="w-full bg-[#f0f4ff]/75 py-16 md:py-20 lg:py-28 border-b border-[#c5c5d4]/40 relative overflow-hidden">
    {{-- Subtle decorative ambient glows --}}
    <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full bg-[#0453cd]/5 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 -left-32 w-96 h-96 rounded-full bg-[#f59e0b]/5 blur-3xl pointer-events-none"></div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative z-10">

        {{-- Section Header (Sesuai Standar design.md) --}}
        <div class="mb-12 sm:mb-16 text-center max-w-3xl mx-auto space-y-3">
            <span class="inline-flex items-center gap-2 rounded-full bg-white border border-[#356ee7]/25 px-4 py-1.5 text-xs font-bold text-[#0453cd] shadow-xs">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                Tanya DAMARA
            </span>
            <h2 class="text-3xl font-extrabold text-[#000c46] tracking-tight sm:text-4xl lg:text-5xl">
                Urusan HIMSI? Gausah <span class="text-[#0453cd]">cari-cari sendiri.</span>
            </h2>
            <p class="text-base sm:text-lg text-[#454652] leading-relaxed">
                DAMARA udah tau dari A sampe Z soal HIMSI — cabang, divisi, rekrutmen, sampe link WA-nya. Tinggal tanya.
            </p>
        </div>

        {{-- Main Showcase Card --}}
        <div class="relative overflow-hidden rounded-3xl border border-[#c5c5d4]/70 bg-white shadow-[0_10px_35px_rgba(0,27,121,0.06)] hover:shadow-[0_16px_45px_rgba(0,27,121,0.09)] transition-all duration-300 isolate">
            {{-- Top Accent Gradient Bar --}}
            <div class="absolute top-0 inset-x-0 h-1.5 bg-gradient-to-r from-[#000c46] via-[#0453cd] to-[#f59e0b]"></div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 p-6 sm:p-10 lg:p-12 items-center">

                {{-- Left Column: Narasi, Identitas & Fitur Unggulan --}}
                <div class="lg:col-span-7 space-y-6 sm:space-y-8">

                    {{-- Mascot Profile Header --}}
                    <div class="flex items-center gap-4">
                        <div class="relative shrink-0">
                            <div class="w-16 h-16 sm:w-18 sm:h-18 rounded-2xl overflow-hidden border-2 border-white shadow-md ring-2 ring-[#0453cd]/20 bg-slate-50">
                                <img src="{{ asset('images/ai-ilustrator.png') }}"
                                     alt="DAMARA — Asisten AI HIMSI UBSI"
                                     class="w-full h-full object-cover">
                            </div>
                            <span class="absolute -bottom-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-emerald-500 border-2 border-white shadow-sm" title="Online 24/7">
                                <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                            </span>
                        </div>
                        <div class="space-y-1">
                            <div class="flex flex-wrap items-center gap-2">
                                <h3 class="text-xl sm:text-2xl font-extrabold text-[#000c46] tracking-tight">DAMARA</h3>
                            </div>
                            <p class="text-xs sm:text-sm font-semibold text-[#0453cd]">Asisten AI Resmi HIMSI UBSI</p>
                        </div>
                    </div>

                    {{-- Value Proposition --}}
                    <div class="space-y-3">
                        <h4 class="text-2xl sm:text-3xl font-extrabold text-[#000c46] tracking-tight leading-snug">
                            Gausah ribet googling atau nanya sana-sini.
                        </h4>
                        <p class="text-sm sm:text-base text-[#454652] leading-relaxed">
                            Semua jawaban DAMARA langsung dari data resmi HIMSI — profil organisasi, info cabang DPC, alur rekrutmen, sampai kontak pengurus. Akurat, bukan tebak-tebakan.
                        </p>
                    </div>

                    {{-- 3 Feature Highlights (Grid) --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3.5">
                        <div class="rounded-2xl border border-[#c5c5d4]/60 bg-[#f9f9fc] p-4 transition-all duration-200 hover:border-[#0453cd]/40 hover:bg-white hover:shadow-xs">
                            <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-blue-50 text-[#0453cd] mb-3">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </span>
                            <p class="text-sm font-bold text-[#000c46]">Bukan asal jawab</p>
                            <p class="text-xs text-[#454652] mt-1 leading-relaxed">Semua dari dokumen & arsip resmi HIMSI</p>
                        </div>

                        <div class="rounded-2xl border border-[#c5c5d4]/60 bg-[#f9f9fc] p-4 transition-all duration-200 hover:border-amber-400/50 hover:bg-white hover:shadow-xs">
                            <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-amber-50 text-amber-600 mb-3">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </span>
                            <p class="text-sm font-bold text-[#000c46]">Tau semua cabang</p>
                            <p class="text-xs text-[#454652] mt-1 leading-relaxed">Info DPC, proker, sampai link WA-nya ada</p>
                        </div>

                        <div class="rounded-2xl border border-[#c5c5d4]/60 bg-[#f9f9fc] p-4 transition-all duration-200 hover:border-emerald-400/50 hover:bg-white hover:shadow-xs">
                            <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 mb-3">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                            </span>
                            <p class="text-sm font-bold text-[#000c46]">Bebas, langsung</p>
                            <p class="text-xs text-[#454652] mt-1 leading-relaxed">Gausah login, gausah bayar, langsung dijawab</p>
                        </div>
                    </div>

                    {{-- Call To Action Row --}}
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 pt-2">
                        <a href="{{ route('ai.index') }}"
                           class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#001b79] px-7 py-3.5 text-sm font-bold text-white shadow-md hover:bg-[#000c46] hover:shadow-lg transition-all duration-200 group">
                            <span>Yuk, tanya DAMARA</span>
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                            </svg>
                        </a>
                        <span class="text-xs text-[#757683] flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Gratis · Gausah login · Langsung dijawab
                        </span>
                    </div>

                </div>

                {{-- Right Column: Interactive Chat Simulation Preview --}}
                <div class="lg:col-span-5 space-y-4">
                    <div class="rounded-2xl border border-[#c5c5d4]/80 bg-[#f9f9fc] shadow-[0_4px_20px_rgba(0,27,121,0.04)] overflow-hidden flex flex-col">
                        
                        {{-- Window Header --}}
                        <div class="px-4 py-3 bg-white border-b border-[#c5c5d4]/50 flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-lg overflow-hidden border border-slate-200 shrink-0 bg-white shadow-xs">
                                <img src="{{ asset('images/ai-ilustrator.png') }}" alt="DAMARA" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <p class="text-xs font-bold text-[#000c46]">DAMARA</p>
                                <p class="text-[10px] text-emerald-600 font-medium flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block"></span>
                                    Online
                                </p>
                            </div>
                        </div>

                        {{-- Simulated Dialogue --}}
                        <div class="p-4 sm:p-5 space-y-3.5 text-xs sm:text-sm">
                            {{-- User Bubble --}}
                            <div class="flex justify-end">
                                <div class="rounded-2xl rounded-tr-xs bg-[#001b79] px-4 py-2.5 text-white shadow-xs max-w-[85%] leading-relaxed">
                                    <p class="text-xs sm:text-sm font-medium">Eh DAMARA, divisi di HIMSI ada apa aja sih?</p>
                                    <span class="block text-[10px] text-blue-200 text-right mt-1">10:42</span>
                                </div>
                            </div>

                            {{-- DAMARA Bubble --}}
                            <div class="flex items-start gap-2.5">
                                <div class="rounded-2xl rounded-tl-xs bg-white border border-[#c5c5d4]/60 p-3.5 shadow-xs text-[#1a1c1e] max-w-[92%] space-y-2 leading-relaxed">
                                    <p class="text-xs sm:text-sm">
                                        Ada <strong>4 divisi</strong> nih — ini dia:
                                    </p>
                                    <ul class="text-[11px] sm:text-xs text-[#454652] space-y-1 pl-1">
                                        <li>• <strong class="text-[#000c46]">Pendidikan</strong>: Seminar, workshop, & study club</li>
                                        <li>• <strong class="text-[#000c46]">Kominfo</strong>: Medsos, konten, & sistem informasi</li>
                                        <li>• <strong class="text-[#000c46]">RSDM</strong>: Pembinaan & database anggota</li>
                                        <li>• <strong class="text-[#000c46]">Litbang</strong>: Riset & evaluasi organisasi</li>
                                    </ul>
                                    <div class="pt-2 border-t border-slate-100 flex items-center gap-1.5 text-[10px] font-semibold text-[#0453cd]">
                                        <svg class="w-3 h-3 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>Terverifikasi dari Profil Divisi HIMSI</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

