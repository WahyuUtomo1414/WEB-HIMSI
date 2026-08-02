<header class="sticky top-0 z-50 border-b border-[#c5c5d4]/60 bg-white/95 backdrop-blur-md shadow-xs">
    <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
        
        {{-- Brand Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3 group">
            <div class="h-11 w-11 rounded-xl bg-[#f0f4ff] p-1.5 border border-[#c5c5d4]/50 flex items-center justify-center transition group-hover:scale-105">
                <img src="/images/placeholder.svg" alt="HIMSI UBSI" class="h-full w-full object-contain">
            </div>
            <div class="flex flex-col">
                <span class="text-lg font-extrabold text-[#000c46] tracking-tight group-hover:text-[#001b79] transition">HIMSI UBSI</span>
                <span class="text-[10px] font-semibold text-[#454652] tracking-wider uppercase">Sistem Informasi</span>
            </div>
        </a>

        {{-- Desktop Navigation --}}
        <nav class="hidden md:flex items-center gap-1">
            <a href="{{ route('home') }}" 
               class="px-4 py-2 text-sm font-semibold rounded-lg transition {{ request()->routeIs('home') ? 'text-[#001b79] bg-[#f0f4ff]' : 'text-[#454652] hover:text-[#000c46] hover:bg-slate-50' }}">
                Beranda
            </a>
            <a href="{{ route('about.index') }}" 
               class="px-4 py-2 text-sm font-semibold rounded-lg transition {{ request()->routeIs('about.*') ? 'text-[#001b79] bg-[#f0f4ff]' : 'text-[#454652] hover:text-[#000c46] hover:bg-slate-50' }}">
                Tentang Kami
            </a>
            <a href="{{ route('branch.index') }}" 
               class="px-4 py-2 text-sm font-semibold rounded-lg transition {{ request()->routeIs('branch.*') ? 'text-[#001b79] bg-[#f0f4ff]' : 'text-[#454652] hover:text-[#000c46] hover:bg-slate-50' }}">
                Cabang
            </a>
            <a href="{{ route('blog.index') }}" 
               class="px-4 py-2 text-sm font-semibold rounded-lg transition {{ request()->routeIs('blog.*') ? 'text-[#001b79] bg-[#f0f4ff]' : 'text-[#454652] hover:text-[#000c46] hover:bg-slate-50' }}">
                Blog
            </a>
            <a href="{{ route('contact.index') }}" 
               class="px-4 py-2 text-sm font-semibold rounded-lg transition {{ request()->routeIs('contact.*') ? 'text-[#001b79] bg-[#f0f4ff]' : 'text-[#454652] hover:text-[#000c46] hover:bg-slate-50' }}">
                Kontak
            </a>
        </nav>

        {{-- Action Button & Mobile Toggle --}}
        <div class="flex items-center gap-3">
            <a href="{{ route('contact.index') }}" class="hidden sm:inline-flex items-center justify-center rounded-xl bg-[#001b79] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#000c46] shadow-sm">
                Hubungi Kami
            </a>

            {{-- Mobile menu button --}}
            <button type="button" 
                    onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
                    class="md:hidden inline-flex items-center justify-center rounded-lg p-2 text-[#454652] hover:bg-slate-100 focus:outline-none"
                    aria-label="Toggle navigation">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="hidden md:hidden border-t border-slate-100 bg-white px-4 pt-3 pb-6 space-y-2">
        <a href="{{ route('home') }}" class="block rounded-lg px-3 py-2.5 text-base font-semibold {{ request()->routeIs('home') ? 'text-[#001b79] bg-[#f0f4ff]' : 'text-[#454652] hover:bg-slate-50' }}">Beranda</a>
        <a href="{{ route('about.index') }}" class="block rounded-lg px-3 py-2.5 text-base font-semibold {{ request()->routeIs('about.*') ? 'text-[#001b79] bg-[#f0f4ff]' : 'text-[#454652] hover:bg-slate-50' }}">Tentang Kami</a>
        <a href="{{ route('branch.index') }}" class="block rounded-lg px-3 py-2.5 text-base font-semibold {{ request()->routeIs('branch.*') ? 'text-[#001b79] bg-[#f0f4ff]' : 'text-[#454652] hover:bg-slate-50' }}">Cabang</a>
        <a href="{{ route('blog.index') }}" class="block rounded-lg px-3 py-2.5 text-base font-semibold {{ request()->routeIs('blog.*') ? 'text-[#001b79] bg-[#f0f4ff]' : 'text-[#454652] hover:bg-slate-50' }}">Blog</a>
        <a href="{{ route('contact.index') }}" class="block rounded-lg px-3 py-2.5 text-base font-semibold {{ request()->routeIs('contact.*') ? 'text-[#001b79] bg-[#f0f4ff]' : 'text-[#454652] hover:bg-slate-50' }}">Kontak</a>
        <div class="pt-2">
            <a href="{{ route('contact.index') }}" class="block w-full text-center rounded-xl bg-[#001b79] px-4 py-3 text-sm font-semibold text-white">Hubungi Kami</a>
        </div>
    </div>
</header>
