<header x-data="{ mobileMenuOpen: false, scrolled: false }" 
        x-init="scrolled = window.scrollY > 20; window.addEventListener('scroll', () => scrolled = window.scrollY > 20)"
        :class="(!scrolled && !mobileMenuOpen) ? 'bg-transparent border-transparent shadow-none' : 'bg-white border-b border-slate-100 shadow-sm'"
        class="fixed top-0 inset-x-0 w-full z-50 transition-all duration-300">
    <nav class="mx-auto flex max-w-7xl items-center justify-between p-4 lg:px-8" aria-label="Global">

        <!-- Logo -->
        <div class="flex lg:flex-1">
            <a href="{{ route('home') }}" class="-m-1.5 p-1.5 flex items-center gap-3 group">
                <img src="/images/placeholder.svg" alt="Logo HIMSI UBSI"
                    class="w-10 h-10 rounded-lg object-contain bg-white shadow-md p-1">
                <div>
                    <span :class="(!scrolled) ? 'text-white' : 'text-[#000c46]'"
                        class="block font-bold text-lg leading-tight tracking-tight transition-colors">HIMSI UBSI</span>
                    <span :class="(!scrolled) ? 'text-slate-200' : 'text-slate-500'"
                        class="block text-xs font-medium transition-colors">Sistem Informasi</span>
                </div>
            </a>
        </div>

        <!-- Mobile menu button -->
        <div class="flex lg:hidden">
            <button type="button" @click="mobileMenuOpen = true"
                :class="(!scrolled) ? 'text-white hover:text-[#356ee7]' : 'text-slate-700 hover:text-[#000c46]'"
                class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 transition-colors">
                <span class="sr-only">Open main menu</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>

        <!-- Desktop Menu -->
        <div class="hidden lg:flex lg:gap-x-8">
            @php
                $navLinks = [
                    ['name' => 'Beranda', 'url' => route('home')],
                    ['name' => 'Tentang Kami', 'url' => route('about.index')],
                    ['name' => 'Cabang', 'url' => route('branch.index')],
                    ['name' => 'Blog', 'url' => route('blog.index')],
                    ['name' => 'Kontak', 'url' => route('contact.index')],
                ];
            @endphp
            @foreach ($navLinks as $link)
                <a href="{{ $link['url'] }}"
                    :class="(!scrolled) ?
                    '{{ request()->url() == $link['url'] ? 'text-white border-b-2 border-[#356ee7]' : 'text-slate-100 hover:text-[#356ee7]' }}' :
                    '{{ request()->url() == $link['url'] ? 'text-[#000c46] border-b-2 border-[#356ee7]' : 'text-slate-600 hover:text-[#000c46]' }}'"
                    class="text-sm font-semibold leading-6 transition-colors">
                    {{ $link['name'] }}
                </a>
            @endforeach
        </div>

        <!-- CTA Button -->
        <div class="hidden lg:flex lg:flex-1 lg:justify-end lg:items-center gap-4">
            <a href="{{ route('contact.index') }}"
                :class="(!scrolled) ? 'bg-white/15 border border-white/20 text-white hover:bg-white/25' :
                'text-white bg-[#000c46] hover:bg-[#001b79]'"
                class="inline-flex items-center gap-2 text-sm font-semibold leading-6 px-5 py-2.5 rounded-full transition-all shadow hover:shadow-md transform hover:-translate-y-0.5">
                Hubungi Kami <svg class="h-4 w-4 text-[#356ee7]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>
    </nav>

    <!-- Mobile Menu Drawer -->
    <div x-show="mobileMenuOpen" class="lg:hidden" role="dialog" aria-modal="true" x-cloak>
        <div x-show="mobileMenuOpen" x-transition.opacity class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm"
            @click="mobileMenuOpen = false"></div>
        <div x-show="mobileMenuOpen" 
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="translate-x-full" 
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-200 transform" 
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-slate-900/10 shadow-2xl">

            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}" class="-m-1.5 p-1.5 flex items-center gap-3">
                    <img src="/images/placeholder.svg" alt="Logo HIMSI UBSI"
                        class="w-8 h-8 rounded object-contain bg-white p-0.5 shadow-sm">
                    <span class="font-bold text-slate-900">HIMSI UBSI</span>
                </a>
                <button type="button" @click="mobileMenuOpen = false"
                    class="-m-2.5 rounded-md p-2.5 text-slate-700 hover:bg-slate-50 transition-colors">
                    <span class="sr-only">Close menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="mt-6 flow-root">
                <div class="-my-6 divide-y divide-slate-100">
                    <div class="space-y-2 py-6">
                        @php
                            $navLinks = [
                                ['name' => 'Beranda', 'url' => route('home')],
                                ['name' => 'Tentang Kami', 'url' => route('about.index')],
                                ['name' => 'Cabang', 'url' => route('branch.index')],
                                ['name' => 'Blog', 'url' => route('blog.index')],
                                ['name' => 'Kontak', 'url' => route('contact.index')],
                            ];
                        @endphp
                        @foreach ($navLinks as $link)
                            <a href="{{ $link['url'] }}"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 {{ request()->url() == $link['url'] ? 'text-[#000c46] bg-slate-50 font-bold' : 'text-slate-900 hover:bg-slate-50' }}">
                                {{ $link['name'] }}
                            </a>
                        @endforeach
                    </div>
                    <div class="py-6">
                        <a href="{{ route('contact.index') }}"
                            class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-white bg-[#000c46] text-center hover:bg-[#001b79] transition-colors">
                            Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
