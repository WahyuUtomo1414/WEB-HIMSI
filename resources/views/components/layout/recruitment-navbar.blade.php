<nav class="fixed top-4 sm:top-6 inset-x-0 z-50 px-4 max-w-5xl mx-auto">
    <div
        class="relative rounded-full bg-slate-900/75 backdrop-blur-xl border border-white/20 shadow-[0_10px_40px_rgba(0,0,0,0.6)] px-5 sm:px-8 py-2.5 flex items-center justify-between gap-4 transition-all duration-300">

        <!-- Logo Brand -->
        <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
            <img src="{{ asset('images/himsi.png') }}" alt="Logo HIMSI"
                class="w-8 h-8 rounded-lg p-0.5 bg-white shadow-md group-hover:scale-110 transition-transform">
            <div class="flex flex-col">
                <span class="text-sm font-black text-white tracking-wider group-hover:text-amber-400 transition-colors">
                    HIMSI <span class="text-amber-400">UBSI</span>
                </span>
                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest -mt-0.5">OPREC 2026</span>
            </div>
        </a>

        <!-- Middle Quick Links -->
        <ul class="hidden md:flex items-center gap-6 text-xs font-extrabold uppercase tracking-wider text-slate-300">
            <li>
                <a href="{{ route('home') }}" class="hover:text-amber-400 transition-colors flex items-center gap-1">
                    <span>← Main Web</span>
                </a>
            </li>
            <li>
                <a href="#about-recruitment" class="hover:text-amber-400 transition-colors">About</a>
            </li>
            <li>
                <a href="#divisions" class="hover:text-amber-400 transition-colors">Divisi</a>
            </li>
            <li>
                <a href="#timeline" class="hover:text-amber-400 transition-colors">Timeline</a>
            </li>
            <li>
                <a href="#faq" class="hover:text-amber-400 transition-colors">FAQ</a>
            </li>
        </ul>

        <!-- Right Action Button -->
        <div class="flex items-center gap-3">
            <a href="{{ route('recruitment.create') }}"
                class="px-4 sm:px-5 py-2 rounded-full bg-gradient-to-r from-amber-500 to-amber-400 hover:from-amber-400 hover:to-amber-300 text-slate-950 font-black text-xs uppercase tracking-wider shadow-[0_0_15px_rgba(245,158,11,0.4)] hover:shadow-[0_0_25px_rgba(245,158,11,0.7)] hover:scale-105 transition-all duration-300 cursor-pointer">
                <span>Daftar Sekarang</span>
            </a>
        </div>
    </div>
</nav>
