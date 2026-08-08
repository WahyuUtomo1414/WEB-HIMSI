<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran Open Recruitment HIMSI 2026</title>
    <link rel="icon" href="{{ asset('images/himsi.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        @keyframes float3dBounce {
            0%, 100% { transform: translateY(0px) rotate(0deg) scale(1); }
            50% { transform: translateY(-20px) rotate(6deg) scale(1.08); }
        }
        @keyframes starTwinkleFast {
            0%, 100% { opacity: 0.2; transform: scale(0.8); }
            50% { opacity: 1; transform: scale(1.4); filter: drop-shadow(0 0 8px #f59e0b); }
        }
        .anim-3d-bounce { animation: float3dBounce 5s ease-in-out infinite; }
        .star-fast { animation: starTwinkleFast 2s ease-in-out infinite; }
        .star-medium { animation: starTwinkleFast 3.5s ease-in-out infinite; }
    </style>
</head>
<body class="bg-[#030712] text-white selection:bg-amber-400 selection:text-slate-950 overflow-x-hidden">

    <!-- Splash Video Intro Screen -->
    <x-common.splash-screen />

    <!-- Custom Recruitment Cyber Navbar -->
    <x-layout.recruitment-navbar />

    <div class="relative bg-[#030712] min-h-screen pt-28 pb-24 isolate overflow-hidden">

        <!-- Universal Cyber Grid Mesh Background Pattern -->
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff08_1px,transparent_1px),linear-gradient(to_bottom,#ffffff08_1px,transparent_1px)] bg-[size:3.5rem_3.5rem] pointer-events-none z-0"></div>

        <!-- Ambient Glow Orbs & Twinkling Stars -->
        <div aria-hidden="true" class="pointer-events-none absolute inset-0 overflow-hidden z-0">
            <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[850px] h-[550px] bg-gradient-to-tr from-[#001b79]/45 via-[#0453cd]/30 to-indigo-600/35 rounded-full blur-[150px] opacity-80"></div>
            <div class="absolute bottom-1/4 right-10 w-[650px] h-[650px] bg-purple-900/35 rounded-full blur-[170px] opacity-60"></div>
            
            <span class="star-fast absolute text-amber-300 text-xl top-20 left-[10%]">✦</span>
            <span class="star-medium absolute text-blue-400 text-2xl top-40 right-[15%]">✧</span>
            <span class="star-fast absolute text-purple-300 text-lg top-[60vh] left-[5%]">✶</span>
            <span class="star-medium absolute text-amber-200 text-2xl top-[80vh] right-[10%]">✦</span>
        </div>

        <!-- 3D Bouncing Spheres -->
        <div class="anim-3d-bounce absolute top-28 left-8 hidden lg:block pointer-events-none opacity-80 z-10">
            <div class="w-24 h-24 rounded-full bg-gradient-to-br from-amber-400 via-amber-600 to-indigo-900 shadow-[0_0_40px_rgba(245,158,11,0.5)] border border-amber-300/40 relative flex items-center justify-center">
                <div class="w-16 h-16 rounded-full bg-gradient-to-tl from-white/30 to-transparent blur-xs"></div>
            </div>
        </div>

        <div class="anim-3d-bounce absolute top-36 right-8 hidden lg:block pointer-events-none opacity-80 z-10" style="animation-delay: 2.5s;">
            <div class="w-28 h-28 rounded-3xl bg-gradient-to-tr from-blue-600 via-purple-600 to-indigo-900 shadow-[0_0_50px_rgba(59,130,246,0.6)] border border-blue-400/40 rotate-12 flex items-center justify-center backdrop-blur-md">
                <div class="w-16 h-16 rounded-2xl bg-white/20 rotate-45 backdrop-blur-xs"></div>
            </div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <!-- Navigation Back Button -->
            <div class="flex items-center justify-between">
                <a href="{{ route('recruitment.index') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 hover:bg-white/20 text-xs sm:text-sm font-bold text-amber-300 border border-amber-400/30 backdrop-blur-md transition-all hover:-translate-x-1">
                    <span>← Kembali ke Info Rekrutmen</span>
                </a>

                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest hidden sm:inline-block">
                    HIMSI UBSI REKRUTMEN 2026
                </span>
            </div>

            <!-- Page Title Header -->
            <div class="text-center space-y-3">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-400/20 text-amber-300 border border-amber-400/40 text-xs font-black uppercase tracking-widest">
                    <span class="h-2 w-2 rounded-full bg-amber-400 animate-ping"></span>
                    <span>PENDAFTARAN ONLINE PENGURUS 2026</span>
                </div>
                <h1 class="text-3xl sm:text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-100 to-amber-300 tracking-tight">
                    FORMULIR REGISTRASI CALON PENERUS
                </h1>
                <p class="text-xs sm:text-base text-slate-300 max-w-2xl mx-auto font-medium leading-relaxed">
                    Lengkapi data diri Anda dengan teliti. Setelah submit, Anda akan menerima <span class="text-amber-400 font-bold">email konfirmasi otomatis</span> dan langsung terhubung ke <span class="text-emerald-400 font-bold">Grup WhatsApp Cabang</span> pilihan Anda.
                </p>
            </div>

            <!-- Main Form Card Container -->
            <div class="relative rounded-3xl bg-[#070e24]/95 border-2 border-amber-400/50 shadow-[0_0_60px_rgba(245,158,11,0.3)] p-6 sm:p-12 backdrop-blur-2xl text-white space-y-8">
                
                @if ($errors->any())
                    <div class="p-4 rounded-2xl bg-red-500/20 border border-red-500/50 text-red-200 text-xs sm:text-sm space-y-1">
                        <p class="font-extrabold text-red-400">⚠️ Mohon periksa kembali inputan Anda:</p>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('recruitment.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Row 1: Nama & NIM -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-black uppercase tracking-wider text-amber-400 mb-2">Nama Lengkap *</label>
                            <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Budi Pratama" 
                                   class="w-full px-4 py-3.5 rounded-2xl bg-white/5 border border-white/15 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 text-sm font-medium transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-black uppercase tracking-wider text-amber-400 mb-2">NIM (Nomor Induk Mahasiswa) *</label>
                            <input type="text" name="nim" value="{{ old('nim') }}" required placeholder="Contoh: 12234567" 
                                   class="w-full px-4 py-3.5 rounded-2xl bg-white/5 border border-white/15 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 text-sm font-medium transition-all">
                        </div>
                    </div>

                    <!-- Row 2: Semester & Cabang DPC -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-black uppercase tracking-wider text-amber-400 mb-2">Semester Saat Ini *</label>
                            <select name="semester" required class="w-full px-4 py-3.5 rounded-2xl bg-[#030712] border border-white/15 text-white focus:outline-none focus:border-amber-400 text-sm font-medium transition-all">
                                <option value="">-- Pilih Semester --</option>
                                <option value="Semester 1" {{ old('semester') == 'Semester 1' ? 'selected' : '' }}>Semester 1</option>
                                <option value="Semester 2" {{ old('semester') == 'Semester 2' ? 'selected' : '' }}>Semester 2</option>
                                <option value="Semester 3" {{ old('semester') == 'Semester 3' ? 'selected' : '' }}>Semester 3</option>
                                <option value="Semester 4" {{ old('semester') == 'Semester 4' ? 'selected' : '' }}>Semester 4</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-black uppercase tracking-wider text-amber-400 mb-2">Cabang DPC Pilihan *</label>
                            <select name="branch_id" required class="w-full px-4 py-3.5 rounded-2xl bg-[#030712] border border-white/15 text-white focus:outline-none focus:border-amber-400 text-sm font-medium transition-all">
                                <option value="">-- Pilih Cabang (DPC) --</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                                        {{ $branch->name }} ({{ $branch->location }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Row 3: Email & No WA -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-black uppercase tracking-wider text-amber-400 mb-2">Email UBSI / Email Pribadi *</label>
                            <input type="email" name="email" value="{{ old('email') }}" required placeholder="nama@gmail.com" 
                                   class="w-full px-4 py-3.5 rounded-2xl bg-white/5 border border-white/15 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 text-sm font-medium transition-all">
                            <span class="text-[10px] text-slate-400 mt-1 block">Email konfirmasi akan dikirimkan langsung ke alamat ini.</span>
                        </div>
                        <div>
                            <label class="block text-xs font-black uppercase tracking-wider text-amber-400 mb-2">No. WhatsApp Aktif *</label>
                            <input type="tel" name="no_wa" value="{{ old('no_wa') }}" required placeholder="Contoh: 08123456789" 
                                   class="w-full px-4 py-3.5 rounded-2xl bg-white/5 border border-white/15 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 text-sm font-medium transition-all">
                        </div>
                    </div>

                    <!-- Row 4: Instagram & Follow IG -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-black uppercase tracking-wider text-amber-400 mb-2">Username Instagram *</label>
                            <input type="text" name="instagram" value="{{ old('instagram') }}" required placeholder="@username" 
                                   class="w-full px-4 py-3.5 rounded-2xl bg-white/5 border border-white/15 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 text-sm font-medium transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-black uppercase tracking-wider text-amber-400 mb-2">Upload Bukti Follow Instagram DPC *</label>
                            <input type="file" name="follow_dpc" accept="image/*" required 
                                   class="w-full px-3.5 py-2.5 rounded-2xl bg-white/5 border border-white/15 text-xs text-slate-300 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-amber-400 file:text-slate-950 hover:file:bg-amber-300 cursor-pointer">
                            <span class="text-[10px] text-slate-400 mt-1 block">Upload screenshot (JPG/PNG) bukti telah follow Instagram DPC.</span>
                        </div>
                    </div>

                    <!-- Row 5: Motivasi & Alasan -->
                    <div>
                        <label class="block text-xs font-black uppercase tracking-wider text-amber-400 mb-2">Motivasi & Alasan Ingin Bergabung *</label>
                        <textarea name="description" required rows="4" placeholder="Ceritakan motivasi, pengalaman, dan apa yang ingin Anda kontribusikan di HIMSI UBSI..." 
                                  class="w-full px-4 py-3.5 rounded-2xl bg-white/5 border border-white/15 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 text-sm font-medium transition-all">{{ old('description') }}</textarea>
                    </div>

                    <!-- Row 6: Upload Files -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 p-5 rounded-2xl bg-white/5 border border-white/10">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1">Upload e-KTM * (JPG/PNG/PDF, Max 2MB)</label>
                            <input type="file" name="ektm" accept="image/*,.pdf" required
                                   class="w-full px-3 py-2 rounded-xl bg-white/5 border border-white/15 text-xs text-slate-300 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-amber-400 file:text-slate-950 hover:file:bg-amber-300 cursor-pointer">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1">Upload CV * (PDF, Max 5MB)</label>
                            <input type="file" name="cv" accept=".pdf" required
                                   class="w-full px-3 py-2 rounded-xl bg-white/5 border border-white/15 text-xs text-slate-300 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-amber-400 file:text-slate-950 hover:file:bg-amber-300 cursor-pointer">
                        </div>
                    </div>

                    <!-- Form Action Buttons -->
                    <div class="pt-6 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <a href="{{ route('recruitment.index') }}" 
                           class="w-full sm:w-auto px-6 py-3.5 rounded-xl bg-white/10 text-white font-extrabold text-sm hover:bg-white/20 text-center transition-colors">
                            Batal
                        </a>
                        
                        <button type="submit" 
                                class="w-full sm:w-auto px-10 py-4 rounded-xl bg-gradient-to-r from-amber-500 to-amber-400 hover:from-amber-400 hover:to-amber-300 text-slate-950 font-black text-sm uppercase tracking-wider shadow-[0_0_30px_rgba(245,158,11,0.5)] hover:shadow-[0_0_45px_rgba(245,158,11,0.8)] transition-all transform hover:scale-105 cursor-pointer flex items-center justify-center gap-2">
                            <span>KIRIM PENDAFTARAN & MASUK GRUP WA</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                            </svg>
                        </button>
                    </div>
                </form>

            </div>
        </div>

    </div>

    <!-- Custom Recruitment Cyber Footer -->
    <x-layout.recruitment-footer />

    <!-- Global Floating Animated WhatsApp Button -->
    <div class="fixed bottom-6 right-6 z-[9999]">
        <a href="https://wa.me/6281234567890" target="_blank" rel="noopener" 
           title="Hubungi Kami via WhatsApp"
           class="relative h-16 w-16 rounded-full bg-[#25D366] hover:bg-[#20ba5a] text-white flex items-center justify-center shadow-[0_4px_24px_rgba(37,211,102,0.5)] hover:scale-110 transition-all duration-300 group">
            <span class="absolute inset-0 rounded-full bg-[#25D366] animate-ping opacity-40"></span>
            <svg class="w-9 h-9 relative z-10 text-white fill-current transform group-hover:rotate-12 transition-transform duration-300" viewBox="0 0 24 24">
                <path d="M12.012 2c-5.506 0-9.989 4.478-9.99 9.984 0 1.765.459 3.488 1.334 5.006L2 22l5.12-1.341c1.472.802 3.136 1.225 4.887 1.226h.005c5.505 0 9.988-4.478 9.989-9.984 0-2.668-1.038-5.176-2.924-7.062A9.923 9.923 0 0 0 12.012 2zm0 18.258h-.004a8.272 8.272 0 0 1-4.22-1.161l-.303-.18-3.135.821.836-3.054-.197-.314a8.261 8.261 0 0 1-1.265-4.386c0-4.564 3.714-8.278 8.28-8.278 2.21 0 4.288.862 5.852 2.427a8.232 8.232 0 0 1 2.425 5.853c-.001 4.565-3.715 8.279-8.279 8.279zm4.536-6.195c-.248-.124-1.469-.724-1.696-.807-.227-.083-.393-.124-.559.124-.165.248-.641.807-.786.972-.145.165-.29.186-.538.062-.248-.124-1.047-.386-1.995-1.231-.738-.659-1.236-1.472-1.38-1.72-.146-.248-.016-.382.108-.506.112-.112.248-.29.372-.434.124-.145.165-.248.248-.414.083-.165.041-.31-.021-.434-.062-.124-.559-1.346-.765-1.842-.201-.484-.405-.418-.559-.426l-.476-.008c-.165 0-.434.062-.661.31-.227.248-.868.848-.868 2.07 0 1.221.889 2.4 1.013 2.565.124.165 1.75 2.673 4.239 3.748.592.256 1.055.409 1.416.523.595.19 1.136.163 1.564.1.477-.07 1.469-.6 1.675-1.179.207-.579.207-1.075.145-1.179-.062-.104-.227-.166-.475-.29z"/>
            </svg>
        </a>
    </div>

</body>
</html>
