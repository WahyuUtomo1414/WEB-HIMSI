<footer class="bg-[#000c46] text-white pt-16 pb-12 border-t border-[#001b79]">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-10 md:grid-cols-2 lg:grid-cols-4 pb-12 border-b border-white/10">
            
            {{-- Col 1: Brand --}}
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-xl bg-white p-1 flex items-center justify-center">
                        <img src="/images/placeholder.svg" alt="HIMSI UBSI" class="h-full w-full object-contain">
                    </div>
                    <span class="text-xl font-extrabold text-white tracking-tight">HIMSI UBSI</span>
                </div>
                <p class="text-sm text-slate-300 leading-relaxed">
                    Himpunan Mahasiswa Sistem Informasi Universitas Bina Sarana Informatika. Wadah pengabdian, akademik, dan inovasi teknologi.
                </p>
            </div>

            {{-- Col 2: Quick Links --}}
            <div class="space-y-4">
                <h4 class="text-base font-bold text-white tracking-wide">Navigasi Utama</h4>
                <ul class="space-y-2.5 text-sm text-slate-300">
                    <li><a href="{{ route('home') }}" class="hover:text-[#356ee7] transition">Beranda</a></li>
                    <li><a href="{{ route('about.index') }}" class="hover:text-[#356ee7] transition">Tentang Kami</a></li>
                    <li><a href="{{ route('branch.index') }}" class="hover:text-[#356ee7] transition">Cabang & DPC</a></li>
                    <li><a href="{{ route('blog.index') }}" class="hover:text-[#356ee7] transition">Blog & Artikel</a></li>
                    <li><a href="{{ route('contact.index') }}" class="hover:text-[#356ee7] transition">Kontak Resmi</a></li>
                </ul>
            </div>

            {{-- Col 3: Program & Divisi --}}
            <div class="space-y-4">
                <h4 class="text-base font-bold text-white tracking-wide">Area HIMSI</h4>
                <ul class="space-y-2.5 text-sm text-slate-300">
                    <li><span class="hover:text-white transition cursor_default">DPP & DPC Cabang</span></li>
                    <li><span class="hover:text-white transition cursor_default">Kegiatan Akademik</span></li>
                    <li><span class="hover:text-white transition cursor_default">Pengembangan Teknologi</span></li>
                    <li><span class="hover:text-white transition cursor_default">Pengabdian Masyarakat</span></li>
                </ul>
            </div>

            {{-- Col 4: Contact Info --}}
            <div class="space-y-4">
                <h4 class="text-base font-bold text-white tracking-wide">Hubungi Kami</h4>
                <div class="space-y-3 text-sm text-slate-300">
                    <p class="flex items-start gap-2.5">
                        <svg class="h-5 w-5 text-[#356ee7] shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Universitas Bina Sarana Informatika</span>
                    </p>
                    <p class="flex items-center gap-2.5">
                        <svg class="h-5 w-5 text-[#356ee7] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <a href="mailto:info@himsi.org" class="hover:text-white transition">info@himsi.org</a>
                    </p>
                </div>
            </div>

        </div>

        {{-- Bottom Copyright --}}
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-400">
            <p>&copy; {{ date('Y') }} HIMSI UBSI. All rights reserved.</p>
            <p>Himpunan Mahasiswa Sistem Informasi - Academic Nexus</p>
        </div>
    </div>
</footer>
