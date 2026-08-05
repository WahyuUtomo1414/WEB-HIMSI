<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Open Recruitment HIMSI UBSI 2026 | Lead The Future</title>
    <link rel="icon" href="{{ asset('images/himsi.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        @keyframes floatSway {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-14px) rotate(2deg); }
        }
        @keyframes float3dBounce {
            0%, 100% { transform: translateY(0px) rotate(0deg) scale(1); }
            50% { transform: translateY(-24px) rotate(6deg) scale(1.08); }
        }
        @keyframes float3dBounceAlt {
            0%, 100% { transform: translateY(0px) rotate(0deg) scale(1); }
            50% { transform: translateY(22px) rotate(-6deg) scale(0.94); }
        }
        @keyframes glowPulse {
            0%, 100% { opacity: 0.45; transform: scale(1); }
            50% { opacity: 0.85; transform: scale(1.06); }
        }
        @keyframes starTwinkleFast {
            0%, 100% { opacity: 0.2; transform: scale(0.8); }
            50% { opacity: 1; transform: scale(1.4); filter: drop-shadow(0 0 10px #f59e0b); }
        }
        .anim-float { animation: floatSway 6s ease-in-out infinite; }
        .anim-3d-bounce { animation: float3dBounce 5s ease-in-out infinite; }
        .anim-3d-bounce-alt { animation: float3dBounceAlt 6.5s ease-in-out infinite; }
        .anim-glow { animation: glowPulse 4s ease-in-out infinite; }
        .star-fast { animation: starTwinkleFast 2s ease-in-out infinite; }
        .star-medium { animation: starTwinkleFast 3.5s ease-in-out infinite; }
    </style>
</head>
<body class="bg-[#030712] text-white selection:bg-amber-400 selection:text-slate-950 overflow-x-hidden">

    <!-- Splash Video Intro Screen -->
    <x-common.splash-screen />

    <!-- Custom Recruitment Cyber Navbar -->
    <x-layout.recruitment-navbar />

    <div x-data="{ 
            selectedDivision: null,
            openModal: false,
            openFaq: null,
            showRegisterModal: false,
            formData: { name: '', nim: '', email: '', phone: '', division: '', reason: '' },
            submitted: false,
            submitForm() {
                this.submitted = true;
                setTimeout(() => {
                    this.showRegisterModal = false;
                    this.submitted = false;
                    alert('Terima kasih! Pendaftaran Anda berhasil dikirim. Tim HIMSI UBSI akan menghubungi Anda melalui WhatsApp.');
                }, 1500);
            }
         }" 
         class="relative bg-[#030712] min-h-screen pt-12 isolate overflow-hidden">

        <!-- Universal Cyber Grid Mesh Background Pattern -->
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff08_1px,transparent_1px),linear-gradient(to_bottom,#ffffff08_1px,transparent_1px)] bg-[size:3.5rem_3.5rem] pointer-events-none z-0"></div>

        <!-- Dynamic Cosmic Ambient Glow Orbs -->
        <div aria-hidden="true" class="pointer-events-none absolute inset-0 overflow-hidden z-0">
            <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[900px] h-[600px] bg-gradient-to-tr from-[#001b79]/45 via-[#0453cd]/30 to-indigo-600/35 rounded-full blur-[150px] opacity-80 anim-glow"></div>
            <div class="absolute top-2/3 right-10 w-[700px] h-[700px] bg-purple-900/35 rounded-full blur-[170px] opacity-60 anim-glow" style="animation-delay: 2s;"></div>
            <div class="absolute bottom-1/4 left-10 w-[600px] h-[600px] bg-amber-500/15 rounded-full blur-[160px] opacity-50 anim-glow" style="animation-delay: 1s;"></div>

            <!-- Dense Twinkling Stars Scattered Across Page -->
            <span class="star-fast absolute text-amber-300 font-bold text-xl top-24 left-[8%]">✦</span>
            <span class="star-medium absolute text-blue-400 font-bold text-2xl top-48 right-[12%]">✧</span>
            <span class="star-fast absolute text-purple-300 font-bold text-xl top-[35vh] left-[4%]">✶</span>
            <span class="star-medium absolute text-amber-200 font-bold text-2xl top-[65vh] right-[6%]">✧</span>
            <span class="star-fast absolute text-blue-300 font-bold text-xl top-[105vh] left-[10%]">✦</span>
            <span class="star-medium absolute text-indigo-300 font-bold text-2xl top-[145vh] right-[18%]">✶</span>
            <span class="star-fast absolute text-amber-400 font-bold text-xl top-[195vh] left-[6%]">✧</span>
            <span class="star-medium absolute text-purple-400 font-bold text-2xl top-[245vh] right-[8%]">✦</span>
            <span class="star-fast absolute text-blue-400 font-bold text-xl top-[295vh] left-[14%]">✶</span>
        </div>

        <!-- ================= HERO SECTION ================= -->
        <section class="relative z-10 pt-28 pb-20 lg:pt-36 lg:pb-32 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto text-center">
            
            <!-- 3D Bouncing Spheres & Cubes in Hero -->
            <div class="anim-3d-bounce absolute top-20 left-4 hidden lg:block pointer-events-none opacity-85 z-20">
                <div class="w-24 h-24 rounded-full bg-gradient-to-br from-amber-400 via-amber-600 to-indigo-900 shadow-[0_0_40px_rgba(245,158,11,0.6)] border border-amber-300/50 flex items-center justify-center">
                    <div class="w-16 h-16 rounded-full bg-gradient-to-tl from-white/40 to-transparent blur-xs"></div>
                </div>
            </div>

            <div class="anim-3d-bounce-alt absolute top-28 right-6 hidden lg:block pointer-events-none opacity-85 z-20">
                <div class="w-28 h-28 rounded-3xl bg-gradient-to-tr from-blue-600 via-purple-600 to-indigo-900 shadow-[0_0_50px_rgba(59,130,246,0.7)] border border-blue-400/50 rotate-12 flex items-center justify-center backdrop-blur-md">
                    <div class="w-16 h-16 rounded-2xl bg-white/25 rotate-45 backdrop-blur-xs"></div>
                </div>
            </div>

            <!-- Animated Top Badge -->
            <div class="anim-float inline-flex items-center gap-2.5 px-5 py-2.5 rounded-full bg-white/10 border border-amber-400/50 text-amber-300 text-xs sm:text-sm font-black backdrop-blur-md shadow-[0_0_30px_rgba(245,158,11,0.3)] mb-8">
                <span class="h-2.5 w-2.5 rounded-full bg-amber-400 animate-ping"></span>
                <span>OPEN RECRUITMENT HIMSI UBSI 2026</span>
            </div>

            <!-- Main Title H1 -->
            <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black tracking-tight leading-tight text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-100 to-amber-300 drop-shadow-[0_0_40px_rgba(255,255,255,0.25)] max-w-5xl mx-auto">
                LEAD THE FUTURE OF DIGITAL INNOVATION
            </h1>

            <p class="mt-6 text-base sm:text-xl text-slate-300 font-medium max-w-3xl mx-auto leading-relaxed">
                Bergabunglah bersama keluarga besar <span class="text-amber-400 font-bold">HIMSI UBSI</span>. Asah potensi diri, bangun portofolio nyata, dan ciptakan karya teknologi serta kepemimpinan yang berdampak!
            </p>

            <!-- CTA Buttons -->
            <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-5">
                <a href="{{ route('recruitment.create') }}" 
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 rounded-full bg-gradient-to-r from-amber-500 to-amber-400 hover:from-amber-400 hover:to-amber-300 text-slate-950 font-black text-sm sm:text-base tracking-wide shadow-[0_0_35px_rgba(245,158,11,0.6)] hover:shadow-[0_0_55px_rgba(245,158,11,0.9)] transition-all duration-300 transform hover:scale-105 group cursor-pointer">
                    <span>DAFTAR SEKARANG</span>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                    </svg>
                </a>

                <a href="#divisions" 
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 rounded-full bg-white/10 hover:bg-white/20 text-white border border-white/20 font-bold text-sm sm:text-base backdrop-blur-md transition-all duration-300 hover:scale-105">
                    <span>Eksplorasi Divisi</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                    </svg>
                </a>
            </div>

            <!-- Quick Stat Cards -->
            <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-4 max-w-4xl mx-auto pt-8 border-t border-white/10">
                <div class="p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md hover:scale-105 transition-transform">
                    <span class="block text-2xl sm:text-3xl font-black text-amber-400">6+</span>
                    <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Divisi Pilihan</span>
                </div>
                <div class="p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md hover:scale-105 transition-transform">
                    <span class="block text-2xl sm:text-3xl font-black text-blue-400">100%</span>
                    <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Gratis Pendaftaran</span>
                </div>
                <div class="p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md hover:scale-105 transition-transform">
                    <span class="block text-2xl sm:text-3xl font-black text-purple-400">E-Sertifikat</span>
                    <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Resmi Kampus</span>
                </div>
                <div class="p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md hover:scale-105 transition-transform">
                    <span class="block text-2xl sm:text-3xl font-black text-emerald-400">Relasi</span>
                    <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Skala Nasional</span>
                </div>
            </div>
        </section>

        <!-- ================= BENEFIT SECTION ================= -->
        <section id="about-recruitment" class="relative z-10 py-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
            
            <!-- 3D Bouncing Element in Benefit -->
            <div class="anim-3d-bounce-alt absolute -top-10 right-8 hidden lg:block pointer-events-none opacity-70">
                <div class="w-20 h-20 rounded-full bg-gradient-to-tr from-emerald-500 via-teal-600 to-indigo-900 shadow-[0_0_35px_rgba(16,185,129,0.5)] border border-emerald-400/40"></div>
            </div>

            <div class="text-center space-y-3 mb-16">
                <span class="text-xs font-black uppercase tracking-[0.25em] text-blue-400">Benefit Berharga</span>
                <h2 class="text-3xl sm:text-5xl font-black tracking-tight text-white">Mengapa Harus Bergabung?</h2>
                <p class="text-slate-400 text-sm sm:text-base max-w-2xl mx-auto">Pengalaman organisasi di HIMSI UBSI memberikan nilai tambah nyata untuk masa depan karirmu.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Benefit 1 -->
                <div class="group p-8 rounded-3xl bg-gradient-to-b from-white/10 to-white/5 border border-white/10 hover:border-blue-500/50 backdrop-blur-xl transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_0_40px_rgba(59,130,246,0.3)]">
                    <div class="h-14 w-14 rounded-2xl bg-blue-500/20 text-blue-400 border border-blue-500/40 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 2.625a3.75 3.75 0 10-7.5 0 3.75 3.75 0 007.5 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Portfolio & Real Project</h3>
                    <p class="text-sm text-slate-300 leading-relaxed">Terlibat langsung dalam eksekusi event IT nasional, manajemen media, dan pengembangan proyek digital nyata.</p>
                </div>

                <!-- Benefit 2 -->
                <div class="group p-8 rounded-3xl bg-gradient-to-b from-white/10 to-white/5 border border-white/10 hover:border-amber-500/50 backdrop-blur-xl transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_0_40px_rgba(245,158,11,0.3)]">
                    <div class="h-14 w-14 rounded-2xl bg-amber-500/20 text-amber-400 border border-amber-500/40 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a5.97 5.97 0 00-.942 3.197"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Leadership & Soft Skills</h3>
                    <p class="text-sm text-slate-300 leading-relaxed">Asah kemampuan *public speaking*, manajemen waktu, diplomasi, serta kepemimpinan yang dibutuhkan di dunia kerja.</p>
                </div>

                <!-- Benefit 3 -->
                <div class="group p-8 rounded-3xl bg-gradient-to-b from-white/10 to-white/5 border border-white/10 hover:border-purple-500/50 backdrop-blur-xl transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_0_40px_rgba(168,85,247,0.3)]">
                    <div class="h-14 w-14 rounded-2xl bg-purple-500/20 text-purple-400 border border-purple-500/40 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 003-3V8.25a3 3 0 00-3-3h-9a3 3 0 00-3 3v7.5a3 3 0 003 3m9 0v-1.5a2.25 2.25 0 00-2.25-2.25h-4.5A2.25 2.25 0 006.75 15v1.5"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Jejaringan & Networking</h3>
                    <p class="text-sm text-slate-300 leading-relaxed">Perluas relasi ke sesama mahasiswa Sistem Informasi se-Indonesia, alumni berprestasi, dan mitra industri.</p>
                </div>
            </div>
        </section>

        <!-- ================= DIVISION CHOOSE SECTION ================= -->
        <section id="divisions" class="relative z-10 py-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
            
            <!-- 3D Bouncing Element in Division -->
            <div class="anim-3d-bounce absolute top-12 left-6 hidden lg:block pointer-events-none opacity-75">
                <div class="w-24 h-24 rounded-2xl bg-gradient-to-br from-amber-500 via-purple-600 to-indigo-900 rotate-45 border border-amber-300/40 shadow-[0_0_40px_rgba(245,158,11,0.5)] flex items-center justify-center">
                    <div class="w-12 h-12 rounded-xl bg-white/20 rotate-12"></div>
                </div>
            </div>

            <div class="text-center space-y-3 mb-16">
                <span class="text-xs font-black uppercase tracking-[0.25em] text-amber-400">Pilihan Divisi</span>
                <h2 class="text-3xl sm:text-5xl font-black tracking-tight text-white">CHOOSE YOUR DIVISION</h2>
                <p class="text-slate-400 text-sm sm:text-base max-w-2xl mx-auto">Pilihlah divisi yang paling sesuai dengan passion dan minat pengembangan diri Anda.</p>
            </div>

            <!-- Division Cards Grid (4 Cards per Row) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($divisions as $div)
                    <div class="group relative rounded-3xl bg-gradient-to-b from-white/10 via-white/5 to-transparent border border-white/15 p-6 sm:p-7 flex flex-col justify-between overflow-hidden backdrop-blur-xl transition-all duration-500 hover:-translate-y-2 hover:border-amber-400/60"
                         style="box-shadow: 0 10px 30px -10px {{ $div['glow'] }}">
                        
                        <div class="space-y-4">
                            <!-- Badge -->
                            <div class="flex items-center justify-between">
                                <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-widest bg-white/10 text-amber-300 border border-white/15">
                                    {{ $div['badge'] }}
                                </span>
                            </div>

                            <h3 class="text-xl sm:text-2xl font-black text-white group-hover:text-amber-300 transition-colors leading-tight">
                                {{ $div['name'] }}
                            </h3>

                            <p class="text-xs sm:text-sm text-slate-300 leading-relaxed font-medium">
                                {{ Str::limit($div['description'], 150, '...') }}
                            </p>
                        </div>

                        <!-- Card Action -->
                        <div class="pt-5 mt-5 border-t border-white/10 flex items-center justify-between">
                            <button @click="selectedDivision = {{ json_encode($div) }}; openModal = true" 
                                    class="text-xs font-extrabold uppercase tracking-wider text-amber-400 hover:text-amber-300 flex items-center gap-1.5 group-hover:translate-x-1 transition-all cursor-pointer">
                                <span>Lihat Syarat & Detail</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- ================= TIMELINE SECTION (MILESTONE DESIGN STYLE) ================= -->
        <section id="timeline" class="relative z-10 py-24 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
            
            <!-- 3D Bouncing Element in Timeline -->
            <div class="anim-3d-bounce-alt absolute top-20 right-8 hidden lg:block pointer-events-none opacity-75">
                <div class="w-22 h-22 rounded-full bg-gradient-to-tr from-blue-500 via-indigo-600 to-purple-900 border border-blue-400/40 shadow-[0_0_40px_rgba(59,130,246,0.6)]"></div>
            </div>

            <div class="text-center space-y-3 mb-16">
                <span class="text-xs font-black uppercase tracking-[0.25em] text-blue-400">Jadwal & Tahapan</span>
                <h2 class="text-3xl sm:text-5xl font-black tracking-tight text-white">RECRUITMENT MILESTONE</h2>
                <p class="text-slate-400 text-sm sm:text-base max-w-2xl mx-auto">Alur perjalanan pendaftaran dan seleksi calon pengurus HIMSI UBSI 2026</p>
            </div>

            <!-- Milestone Vertical Timeline Container -->
            <div class="relative max-w-5xl mx-auto py-6">
                <!-- Vertical Glow Timeline Center Line -->
                <div class="absolute left-4 md:left-1/2 top-0 bottom-0 w-1 bg-gradient-to-b from-blue-500 via-amber-400 to-purple-600 -translate-x-1/2 rounded-full shadow-[0_0_15px_rgba(245,158,11,0.5)]"></div>

                <div class="space-y-12 sm:space-y-16">
                    @foreach ($timelines as $index => $time)
                        <div class="relative flex flex-col md:flex-row items-start md:items-center">
                            <!-- Circular Ring Node (Glowing Node) -->
                            <div class="absolute left-4 md:left-1/2 -translate-x-1/2 top-8 md:top-1/2 md:-translate-y-1/2 h-8 w-8 rounded-full border-4 border-amber-400 bg-[#030712] shadow-[0_0_20px_rgba(245,158,11,0.8)] z-20 flex items-center justify-center">
                                <span class="h-2 w-2 rounded-full bg-amber-400 animate-ping"></span>
                            </div>

                            <!-- Timeline Card Box (Alternating Left & Right) -->
                            <div class="w-full pl-12 md:pl-0 {{ $index % 2 === 0 ? 'md:w-[46%] md:mr-auto md:pr-4 text-left' : 'md:w-[46%] md:ml-auto md:pl-4 text-left' }}">
                                <div class="group rounded-3xl bg-gradient-to-b from-white/10 via-white/5 to-transparent p-6 sm:p-8 border border-white/15 backdrop-blur-xl shadow-2xl hover:border-amber-400/60 hover:scale-105 transition-all duration-300 space-y-4">
                                    
                                    <!-- Step Number & Date -->
                                    <div class="flex items-center justify-between">
                                        <span class="text-3xl sm:text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r {{ $time['color'] }}">
                                            {{ $time['step'] }}
                                        </span>
                                        <span class="px-3.5 py-1 rounded-full text-xs font-black bg-amber-400/20 text-amber-300 border border-amber-400/40">
                                            {{ $time['date'] }}
                                        </span>
                                    </div>

                                    <!-- Title -->
                                    <h3 class="text-xl sm:text-2xl font-black text-white group-hover:text-amber-300 transition-colors">
                                        {{ $time['title'] }}
                                    </h3>

                                    <!-- Description -->
                                    <p class="text-sm text-slate-300 leading-relaxed font-medium">
                                        {{ $time['desc'] }}
                                    </p>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- ================= FAQ SECTION ================= -->
        <section id="faq" class="relative z-10 py-20 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
            <div class="text-center space-y-3 mb-16">
                <span class="text-xs font-black uppercase tracking-[0.25em] text-purple-400">Pertanyaan Umum</span>
                <h2 class="text-3xl sm:text-5xl font-black tracking-tight text-white">FREQUENTLY ASKED QUESTIONS</h2>
            </div>

            <div class="space-y-4">
                @foreach ($faqs as $index => $faq)
                    <div class="rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md overflow-hidden transition-colors">
                        <button @click="openFaq = (openFaq === {{ $index }} ? null : {{ $index }})" 
                                class="w-full p-6 text-left flex items-center justify-between gap-4 font-bold text-white text-base sm:text-lg hover:text-amber-300 transition-colors">
                            <span>{{ $faq['question'] }}</span>
                            <svg class="w-6 h-6 shrink-0 transition-transform duration-300" 
                                 :class="{ 'rotate-180 text-amber-400': openFaq === {{ $index }} }" 
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                            </svg>
                        </button>
                        <div x-show="openFaq === {{ $index }}" 
                             x-transition.opacity
                             class="px-6 pb-6 text-sm text-slate-300 leading-relaxed border-t border-white/5 pt-4">
                            {{ $faq['answer'] }}
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        
        <!-- ================= BOTTOM REGISTER CTA ================= -->
        <section class="relative z-10 py-20 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto text-center">
            <div class="relative rounded-3xl bg-gradient-to-r from-[#001b79] via-[#0453cd] to-[#000c46] p-10 sm:p-16 border border-blue-400/30 overflow-hidden shadow-[0_0_60px_rgba(4,83,205,0.4)]">
                <div class="relative z-10 space-y-6">
                    <span class="inline-block px-4 py-1.5 rounded-full bg-amber-400 text-slate-950 font-black text-xs uppercase tracking-widest">
                        SAATNYA UNTUK UNJUK GIGI
                    </span>

                    <h2 class="text-3xl sm:text-5xl font-black text-white leading-tight">
                        SIAP JADI PENERUS BERIKUTNYA?
                    </h2>

                    <p class="text-slate-200 text-sm sm:text-lg max-w-2xl mx-auto font-medium">
                        Jangan lewatkan kesempatan berharga ini. Daftarkan diri Anda sekarang dan mari bertumbuh bersama kami!
                    </p>

                    <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="{{ route('recruitment.create') }}" 
                           class="w-full sm:w-auto px-8 py-4 rounded-full bg-amber-400 hover:bg-amber-300 text-slate-950 font-black text-base shadow-xl hover:shadow-amber-400/50 transition-all hover:scale-105 cursor-pointer inline-block">
                            ISI FORMULIR PENDAFTARAN
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- ================= DIVISION DETAIL MODAL ================= -->
        <template x-teleport="body">
            <div x-show="openModal" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 @click="openModal = false"
                 class="fixed inset-0 z-[99999] bg-slate-950/85 backdrop-blur-md flex items-center justify-center p-4"
                 style="display: none;">
                
                <div @click.stop 
                     class="relative w-full max-w-2xl bg-[#070e24]/95 border-2 border-amber-400/50 rounded-3xl p-6 sm:p-10 shadow-[0_0_60px_rgba(245,158,11,0.3)] text-white space-y-6 overflow-hidden backdrop-blur-2xl">
                    
                    <!-- Ambient Glow Orb inside Modal -->
                    <div class="absolute -top-24 -right-24 w-64 h-64 bg-amber-400/20 rounded-full blur-3xl pointer-events-none"></div>

                    <!-- Close Button -->
                    <button @click="openModal = false" class="absolute top-5 right-5 text-slate-400 hover:text-white p-2 rounded-full hover:bg-white/10 transition-colors z-20">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <!-- Header -->
                    <div class="space-y-3 relative z-10" x-if="selectedDivision">
                        <div class="flex items-center gap-3">
                            <span class="px-4 py-1.5 rounded-full text-xs font-black bg-amber-400/20 text-amber-300 border border-amber-400/40 uppercase tracking-widest"
                                  x-text="selectedDivision?.badge"></span>
                        </div>
                        <h3 class="text-3xl sm:text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-100 to-amber-300" 
                            x-text="selectedDivision?.name"></h3>
                    </div>

                    <!-- Deskripsi Lengkap Card -->
                    <div class="p-5 rounded-2xl bg-white/5 border border-white/10 space-y-2 relative z-10 backdrop-blur-md">
                        <h4 class="text-xs font-black uppercase tracking-widest text-amber-400 flex items-center gap-1.5">
                            <span>📖</span>
                            <span>Deskripsi Lengkap Divisi</span>
                        </h4>
                        <p class="text-sm sm:text-base text-slate-200 leading-relaxed font-medium" x-text="selectedDivision?.description"></p>
                    </div>

                    <!-- Kualifikasi & Tugas Utama -->
                    <div class="space-y-3 p-5 rounded-2xl bg-white/5 border border-white/10 relative z-10 backdrop-blur-md">
                        <h4 class="text-xs font-black uppercase tracking-widest text-blue-400 flex items-center gap-2">
                            <span>⚡</span>
                            <span>Tugas Utama & Kualifikasi Persyaratan:</span>
                        </h4>
                        <ul class="space-y-3 text-xs sm:text-sm text-slate-200">
                            <template x-for="(req, i) in selectedDivision?.requirements" :key="i">
                                <li class="flex items-start gap-3">
                                    <span class="h-5 w-5 rounded-full bg-amber-400/20 text-amber-400 border border-amber-400/40 flex items-center justify-center text-xs font-black shrink-0 mt-0.5">✓</span>
                                    <span class="leading-relaxed font-medium" x-text="req"></span>
                                </li>
                            </template>
                        </ul>
                    </div>

                    <!-- Modal Actions -->
                    <div class="pt-4 border-t border-white/10 flex flex-col sm:flex-row justify-end gap-3 relative z-10">
                        <button @click="openModal = false" class="px-6 py-3 rounded-xl bg-white/10 text-white font-extrabold text-sm hover:bg-white/20 transition-colors">
                            Tutup
                        </button>
                        <a href="{{ route('recruitment.create') }}" 
                           class="px-8 py-3 rounded-xl bg-gradient-to-r from-amber-500 to-amber-400 hover:from-amber-400 hover:to-amber-300 text-slate-950 font-black text-sm uppercase tracking-wider shadow-[0_0_20px_rgba(245,158,11,0.5)] hover:shadow-[0_0_35px_rgba(245,158,11,0.8)] transition-all transform hover:scale-105 cursor-pointer inline-block text-center">
                            Pilih Divisi Ini & Daftar Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </template>

        <!-- ================= REGISTRATION FORM MODAL ================= -->
        <template x-teleport="body">
            <div x-show="showRegisterModal" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="showRegisterModal = false"
                 class="fixed inset-0 z-[99999] bg-slate-950/85 backdrop-blur-md flex items-center justify-center p-4 overflow-y-auto"
                 style="display: none;">
                
                <div @click.stop 
                     class="relative w-full max-w-2xl bg-[#0a1128] border border-amber-400/40 rounded-3xl p-6 sm:p-10 shadow-2xl text-white space-y-6 my-8">
                    
                    <button @click="showRegisterModal = false" class="absolute top-5 right-5 text-slate-400 hover:text-white">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <div class="space-y-1">
                        <span class="text-xs font-black text-amber-400 uppercase tracking-widest">Formulir Pendaftaran</span>
                        <h3 class="text-2xl sm:text-3xl font-black text-white">REGISTRASI CALON PENERUS 2026</h3>
                        <p class="text-xs sm:text-sm text-slate-300">Isi data diri Anda secara benar untuk mengikuti tahapan seleksi.</p>
                    </div>

                    <form action="{{ route('recruitment.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 pt-2">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-300 mb-1">Nama Lengkap *</label>
                                <input type="text" name="name" required placeholder="Contoh: Budi Pratama" 
                                       class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/15 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-300 mb-1">NIM (Nomor Induk Mahasiswa) *</label>
                                <input type="text" name="nim" required placeholder="Contoh: 12234567" 
                                       class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/15 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 text-sm">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-300 mb-1">Semester *</label>
                                <select name="semester" required class="w-full px-4 py-3 rounded-xl bg-[#030712] border border-white/15 text-white focus:outline-none focus:border-amber-400 text-sm">
                                    <option value="">-- Pilih Semester --</option>
                                    <option value="Semester 1">Semester 1</option>
                                    <option value="Semester 2">Semester 2</option>
                                    <option value="Semester 3">Semester 3</option>
                                    <option value="Semester 4">Semester 4</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-300 mb-1">Cabang DPC Pilihan *</label>
                                <select name="branch_id" required class="w-full px-4 py-3 rounded-xl bg-[#030712] border border-white/15 text-white focus:outline-none focus:border-amber-400 text-sm">
                                    <option value="">-- Pilih Cabang (DPC) --</option>
                                    @foreach ($branches as $b)
                                        <option value="{{ $b->id }}">{{ $b->name }} ({{ $b->location }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-300 mb-1">Email UBSI / Pribadi *</label>
                                <input type="email" name="email" required placeholder="nama@gmail.com" 
                                       class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/15 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-300 mb-1">No. WhatsApp Aktif *</label>
                                <input type="tel" name="no_wa" required placeholder="08123456789" 
                                       class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/15 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 text-sm">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-300 mb-1">Username Instagram *</label>
                                <input type="text" name="instagram" required placeholder="@username" 
                                       class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/15 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-300 mb-1">Bukti Follow Instagram DPC *</label>
                                <input type="text" name="follow_dpc" placeholder="Username IG yang follow" 
                                       class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/15 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 text-sm">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1">Motivasi & Alasan Bergabung *</label>
                            <textarea name="description" required rows="3" placeholder="Mengapa Anda ingin bergabung dengan HIMSI UBSI?" 
                                      class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/15 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 text-sm"></textarea>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-300 mb-1">Upload e-KTM (Opsional)</label>
                                <input type="file" name="ektm" accept="image/*,.pdf" 
                                       class="w-full px-3 py-2 rounded-xl bg-white/5 border border-white/15 text-xs text-slate-300 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-amber-400 file:text-slate-950">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-300 mb-1">Upload CV (PDF, Opsional)</label>
                                <input type="file" name="cv" accept=".pdf" 
                                       class="w-full px-3 py-2 rounded-xl bg-white/5 border border-white/15 text-xs text-slate-300 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-amber-400 file:text-slate-950">
                            </div>
                        </div>

                        <div class="pt-4 flex justify-end gap-3">
                            <button type="button" @click="showRegisterModal = false" class="px-5 py-3 rounded-xl bg-white/10 text-white font-bold text-sm hover:bg-white/20">
                                Batal
                            </button>
                            <button type="submit" 
                                    class="px-8 py-3 rounded-xl bg-gradient-to-r from-amber-500 to-amber-400 hover:from-amber-400 hover:to-amber-300 text-slate-950 font-black text-sm uppercase tracking-wider shadow-[0_0_20px_rgba(245,158,11,0.5)] hover:shadow-[0_0_35px_rgba(245,158,11,0.8)] transition-all cursor-pointer">
                                KIRIM PENDAFTARAN & MASUK GRUP WA
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </template>

    </div>

    <!-- Custom Recruitment Cyber Footer -->
    <x-layout.recruitment-footer />

    <!-- Global Floating Animated WhatsApp Button (Bottom Right) -->
    <div class="fixed bottom-6 right-6 z-[9999]">
        <a href="https://wa.me/6281234567890" target="_blank" rel="noopener" 
           title="Hubungi Kami via WhatsApp"
           class="relative h-16 w-16 rounded-full bg-[#25D366] hover:bg-[#20ba5a] text-white flex items-center justify-center shadow-[0_4px_24px_rgba(37,211,102,0.5)] hover:scale-110 transition-all duration-300 group">
            <!-- Pulsing outer ring animation -->
            <span class="absolute inset-0 rounded-full bg-[#25D366] animate-ping opacity-40"></span>
            
            <!-- WhatsApp Official Icon -->
            <svg class="w-9 h-9 relative z-10 text-white fill-current transform group-hover:rotate-12 transition-transform duration-300" viewBox="0 0 24 24">
                <path d="M12.012 2c-5.506 0-9.989 4.478-9.99 9.984 0 1.765.459 3.488 1.334 5.006L2 22l5.12-1.341c1.472.802 3.136 1.225 4.887 1.226h.005c5.505 0 9.988-4.478 9.989-9.984 0-2.668-1.038-5.176-2.924-7.062A9.923 9.923 0 0 0 12.012 2zm0 18.258h-.004a8.272 8.272 0 0 1-4.22-1.161l-.303-.18-3.135.821.836-3.054-.197-.314a8.261 8.261 0 0 1-1.265-4.386c0-4.564 3.714-8.278 8.28-8.278 2.21 0 4.288.862 5.852 2.427a8.232 8.232 0 0 1 2.425 5.853c-.001 4.565-3.715 8.279-8.279 8.279zm4.536-6.195c-.248-.124-1.469-.724-1.696-.807-.227-.083-.393-.124-.559.124-.165.248-.641.807-.786.972-.145.165-.29.186-.538.062-.248-.124-1.047-.386-1.995-1.231-.738-.659-1.236-1.472-1.38-1.72-.146-.248-.016-.382.108-.506.112-.112.248-.29.372-.434.124-.145.165-.248.248-.414.083-.165.041-.31-.021-.434-.062-.124-.559-1.346-.765-1.842-.201-.484-.405-.418-.559-.426l-.476-.008c-.165 0-.434.062-.661.31-.227.248-.868.848-.868 2.07 0 1.221.889 2.4 1.013 2.565.124.165 1.75 2.673 4.239 3.748.592.256 1.055.409 1.416.523.595.19 1.136.163 1.564.1.477-.07 1.469-.6 1.675-1.179.207-.579.207-1.075.145-1.179-.062-.104-.227-.166-.475-.29z"/>
            </svg>
        </a>
    </div>

</body>
</html>
