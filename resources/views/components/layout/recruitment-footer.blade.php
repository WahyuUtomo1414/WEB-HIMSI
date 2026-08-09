<footer class="relative bg-[#02050e] text-white font-sans overflow-hidden border-t border-white/10 isolate pt-16 pb-12">

    <!-- Custom Inline 3D & Twinkle Animation Styles -->
    <style>
        @keyframes float3dBounce {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg) scale(1);
            }

            50% {
                transform: translateY(-20px) rotate(6deg) scale(1.08);
            }
        }

        @keyframes rotate3dPrism {
            0% {
                transform: rotateX(0deg) rotateY(0deg) rotateZ(0deg);
            }

            100% {
                transform: rotateX(360deg) rotateY(360deg) rotateZ(360deg);
            }
        }

        @keyframes starTwinkleFast {

            0%,
            100% {
                opacity: 0.2;
                transform: scale(0.8);
            }

            50% {
                opacity: 1;
                transform: scale(1.4);
                filter: drop-shadow(0 0 8px #f59e0b);
            }
        }

        @keyframes borderPulse {

            0%,
            100% {
                border-color: rgba(245, 158, 11, 0.3);
            }

            50% {
                border-color: rgba(59, 130, 246, 0.7);
            }
        }

        .anim-3d-bounce {
            animation: float3dBounce 5s ease-in-out infinite;
        }

        .anim-3d-prism {
            animation: rotate3dPrism 15s linear infinite;
        }

        .star-fast {
            animation: starTwinkleFast 2s ease-in-out infinite;
        }

        .star-medium {
            animation: starTwinkleFast 3.5s ease-in-out infinite;
        }

        .border-pulse {
            animation: borderPulse 4s infinite;
        }
    </style>

    <!-- Cyber Background Stars, Grid & 3D Objects Ambient Backdrop -->
    <div class="absolute inset-0 pointer-events-none z-0 overflow-hidden">
        <!-- Cyber Mesh Background Grid -->
        <div
            class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff08_1px,transparent_1px),linear-gradient(to_bottom,#ffffff08_1px,transparent_1px)] bg-[size:3.5rem_3.5rem]">
        </div>

        <!-- Ambient Nebula Glow Orbs -->
        <div
            class="absolute top-[-30%] left-[-10%] w-[60%] h-[160%] bg-gradient-to-tr from-blue-600/15 via-indigo-600/10 to-transparent blur-[140px] rounded-full">
        </div>
        <div
            class="absolute bottom-[-30%] right-[-10%] w-[60%] h-[160%] bg-gradient-to-bl from-purple-600/15 via-amber-500/10 to-transparent blur-[150px] rounded-full">
        </div>

        <!-- Dense Twinkling Star Field -->
        <span class="star-fast absolute text-amber-300 text-xl top-8 left-[8%]">✦</span>
        <span class="star-medium absolute text-blue-400 text-2xl top-16 right-[12%]">✧</span>
        <span class="star-fast absolute text-purple-300 text-lg top-32 left-[45%]">✶</span>
        <span class="star-medium absolute text-amber-200 text-2xl top-24 right-[35%]">✦</span>
        <span class="star-fast absolute text-blue-300 text-xl bottom-28 left-[15%]">✧</span>
        <span class="star-medium absolute text-indigo-300 text-2xl bottom-16 right-[22%]">✶</span>
        <span class="star-fast absolute text-amber-400 text-lg bottom-36 left-[70%]">✧</span>

        <!-- 3D Floating Sphere Element Left -->
        <div class="anim-3d-bounce absolute top-12 left-10 hidden xl:block z-10 opacity-75">
            <div
                class="w-24 h-24 rounded-full bg-gradient-to-br from-amber-400 via-amber-600 to-indigo-900 shadow-[0_0_40px_rgba(245,158,11,0.5)] border border-amber-300/40 relative flex items-center justify-center">
                <div class="w-16 h-16 rounded-full bg-gradient-to-tl from-white/30 to-transparent blur-xs"></div>
            </div>
        </div>

        <!-- 3D Floating Cyber Prism Element Right -->
        <div class="anim-3d-bounce absolute bottom-12 right-12 hidden xl:block z-10 opacity-75"
            style="animation-delay: 2.5s;">
            <div
                class="w-28 h-28 rounded-3xl bg-gradient-to-tr from-blue-600 via-purple-600 to-indigo-900 shadow-[0_0_50px_rgba(59,130,246,0.6)] border border-blue-400/40 rotate-12 flex items-center justify-center backdrop-blur-md">
                <div class="w-16 h-16 rounded-2xl bg-white/20 rotate-45 backdrop-blur-xs"></div>
            </div>
        </div>
    </div>

    <!-- Main Footer Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8 space-y-12">

        <!-- Top Banner CTA Card -->
        <div
            class="relative rounded-3xl bg-gradient-to-r from-slate-900/90 via-[#001b79]/60 to-slate-900/90 border border-pulse p-8 sm:p-12 backdrop-blur-2xl shadow-[0_0_50px_rgba(0,27,121,0.5)] flex flex-col md:flex-row items-center justify-between gap-6 overflow-hidden">
            <!-- 3D Floating Badge inside Banner -->
            <div class="space-y-2 text-center md:text-left">
                <div
                    class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-amber-400/20 text-amber-300 border border-amber-400/40 text-xs font-black uppercase tracking-widest">
                    <span class="h-2 w-2 rounded-full bg-amber-400 animate-ping"></span>
                    <span>BERGABUNGLAH BERSAMA HIMSI 2026</span>
                </div>
                <h3 class="text-2xl sm:text-4xl font-black text-white">
                    SIAP JADI PENERUS BERIKUTNYA?
                </h3>
                <p class="text-xs sm:text-sm text-slate-300">
                    Daftarkan dirimu sebelum batas akhir pendaftaran ditutup!
                </p>
            </div>

            <a href="{{ route('recruitment.create') }}"
                class="shrink-0 px-8 py-4 rounded-full bg-gradient-to-r from-amber-500 to-amber-400 hover:from-amber-400 hover:to-amber-300 text-slate-950 font-black text-sm uppercase tracking-wider shadow-[0_0_30px_rgba(245,158,11,0.6)] hover:shadow-[0_0_50px_rgba(245,158,11,0.9)] hover:scale-105 transition-all cursor-pointer">
                🚀 FORMULIR PENDAFTARAN
            </a>
        </div>

        <!-- 4-Column Footer Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10">

            <!-- Col 1: Brand Info (2 Columns Wide) -->
            <div class="lg:col-span-2 space-y-5">
                <div class="flex items-center gap-3.5">
                    <div class="relative group">
                        <div
                            class="absolute -inset-1 rounded-2xl bg-gradient-to-r from-amber-400 via-blue-500 to-purple-600 blur-sm opacity-75 group-hover:opacity-100 transition-opacity">
                        </div>
                        <img src="{{ asset('images/himsi.png') }}" alt="Logo HIMSI"
                            class="relative w-12 h-12 rounded-xl bg-white p-1 shadow-2xl object-contain">
                    </div>
                    <div>
                        <h2
                            class="text-2xl font-black tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-200 to-amber-400">
                            HIMSI REKRUTMEN
                        </h2>
                        <p class="text-amber-400 font-black text-xs tracking-widest uppercase">PERIODE 2026 / 2027</p>
                    </div>
                </div>

                <p class="text-slate-300 text-sm leading-relaxed max-w-md font-medium">
                    Wadah resmi transformasi kepemimpinan dan inovasi teknologi bagi seluruh mahasiswa Sistem Informasi
                    UBSI. Bergabunglah dan bertumbuh bersama kami!
                </p>

                <!-- Live Status Card -->
                <div
                    class="inline-flex items-center gap-3 p-3 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md">
                    <span class="h-3 w-3 rounded-full bg-emerald-400 animate-ping"></span>
                    <span class="text-xs font-bold text-emerald-300 uppercase tracking-wider">Status: Pendaftaran Online
                        Dibuka</span>
                </div>
            </div>

            <!-- Col 2: Navigation Links -->
            <div class="space-y-4">
                <h4 class="text-sm font-black uppercase tracking-widest text-amber-400 flex items-center gap-2">
                    <span>✧</span>
                    <span>Navigasi</span>
                </h4>
                <ul class="space-y-2.5 text-xs font-bold text-slate-300">
                    <li>
                        <a href="{{ route('home') }}"
                            class="hover:text-amber-300 transition-all flex items-center gap-1 group">
                            <span class="group-hover:-translate-x-1 transition-transform">←</span>
                            <span>Web Utama HIMSI</span>
                        </a>
                    </li>
                    <li>
                        <a href="#about-recruitment"
                            class="hover:text-amber-300 transition-all flex items-center gap-1 group">
                            <span class="group-hover:translate-x-1 transition-transform">›</span>
                            <span>Mengapa HIMSI</span>
                        </a>
                    </li>
                    <li>
                        <a href="#divisions" class="hover:text-amber-300 transition-all flex items-center gap-1 group">
                            <span class="group-hover:translate-x-1 transition-transform">›</span>
                            <span>Pilihan Divisi</span>
                        </a>
                    </li>
                    <li>
                        <a href="#timeline" class="hover:text-amber-300 transition-all flex items-center gap-1 group">
                            <span class="group-hover:translate-x-1 transition-transform">›</span>
                            <span>Tahapan Rekrutmen</span>
                        </a>
                    </li>
                    <li>
                        <a href="#faq" class="hover:text-amber-300 transition-all flex items-center gap-1 group">
                            <span class="group-hover:translate-x-1 transition-transform">›</span>
                            <span>Tanya Jawab (FAQ)</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Col 3: Helpdesk & Contact -->
            <div class="space-y-4">
                <h4 class="text-sm font-black uppercase tracking-widest text-amber-400 flex items-center gap-2">
                    <span>✦</span>
                    <span>Helpdesk</span>
                </h4>
                <ul class="space-y-3 text-xs text-slate-300 font-medium">
                    <li class="p-3 rounded-xl bg-white/5 border border-white/10 space-y-1">
                        <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest">WhatsApp
                            Panitia</span>
                        <span class="text-sm font-bold text-emerald-400">0895-4061-89600</span>
                    </li>
                    <li class="p-3 rounded-xl bg-white/5 border border-white/10 space-y-1">
                        <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest">Email
                            Official</span>
                        <a href="mailto:himsi@bsi.ac.id"
                            class="text-sm font-bold text-blue-400 hover:underline">himsi@bsi.ac.id</a>
                    </li>
                </ul>
            </div>

            <!-- Col 4: Social Icons (Bounce Animation Removed, Clean Hover Scale) -->
            <div class="space-y-4">
                <h4 class="text-sm font-black uppercase tracking-widest text-amber-400 flex items-center gap-2">
                    <span>✶</span>
                    <span>Media Sosial</span>
                </h4>
                <p class="text-xs text-slate-400">Ikuti pembaharuan informasi melalui kanal resmi kami:</p>
                <div class="flex flex-wrap items-center gap-3">
                    <!-- Instagram -->
                    <a href="https://instagram.com/himsi.ubsi" target="_blank"
                        class="h-11 w-11 rounded-2xl bg-gradient-to-br from-purple-600 to-pink-600 text-white flex items-center justify-center shadow-lg hover:shadow-[0_0_20px_rgba(236,72,153,0.8)] hover:scale-110 transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                    </a>

                    <!-- TikTok -->
                    <a href="https://tiktok.com/@himsi.ubsi" target="_blank"
                        class="h-11 w-11 rounded-2xl bg-gradient-to-br from-slate-800 to-slate-950 border border-white/20 text-white flex items-center justify-center shadow-lg hover:shadow-[0_0_20px_rgba(255,255,255,0.6)] hover:scale-110 transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 448 512">
                            <path
                                d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z" />
                        </svg>
                    </a>

                    <!-- YouTube -->
                    <a href="https://youtube.com/@himsiubsi" target="_blank"
                        class="h-11 w-11 rounded-2xl bg-gradient-to-br from-red-600 to-red-700 text-white flex items-center justify-center shadow-lg hover:shadow-[0_0_20px_rgba(239,68,68,0.8)] hover:scale-110 transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Animated Top Gradient Border Divider -->
        <div class="h-[2px] w-full bg-gradient-to-r from-transparent via-amber-400 via-blue-500 to-transparent"></div>

        <!-- Clean Copyright Section & Developer Credit -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 text-xs text-slate-400 font-medium">
            <!-- Left Side: Developer Credit (Top) + Copyright (Bottom) -->
            <div class="space-y-1">
                <div class="flex items-center gap-1.5 text-slate-300 font-medium">
                    <span>Dikembangkan oleh</span>
                    <span class="text-amber-400 font-bold">Divisi Pendidikan</span>
                </div>
                <p>© 2026 HIMSI UBSI. All rights reserved.</p>
            </div>

            <!-- Right Side: Full Organization Name -->
            <p class="text-slate-300 font-medium sm:text-right">
                Himpunan Mahasiswa Sistem Informasi - Universitas Bina Sarana Informatika
            </p>
        </div>
    </div>
</footer>
