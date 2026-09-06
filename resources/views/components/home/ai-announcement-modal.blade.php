<div x-data="{
        showModal: false,
        isDismissed() {
            try {
                if (localStorage.getItem('himsi_ai_modal_dismissed') === 'true') return true;
                if (sessionStorage.getItem('himsi_ai_modal_dismissed') === 'true') return true;
            } catch (e) {}
            if (document.cookie.indexOf('himsi_ai_modal_dismissed=true') !== -1) return true;
            return false;
        },
        markDismissed() {
            try { localStorage.setItem('himsi_ai_modal_dismissed', 'true'); } catch (e) {}
            try { sessionStorage.setItem('himsi_ai_modal_dismissed', 'true'); } catch (e) {}
            document.cookie = 'himsi_ai_modal_dismissed=true; path=/; max-age=31536000; SameSite=Lax';

            try {
                const token = document.querySelector('meta[name=csrf-token]')?.getAttribute('content') || '';
                fetch('{{ route('ai.dismiss-modal') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                }).catch(() => {});
            } catch (e) {}
        },
        init() {
            if (this.isDismissed()) {
                return;
            }

            // Mark as seen immediately so any fast reload or page change won't re-trigger it
            this.markDismissed();

            // Wait for splash screen loading animation to conclude (~3.8s)
            setTimeout(() => {
                this.showModal = true;
            }, 4000);
        },
        dismiss() {
            this.showModal = false;
            this.markDismissed();
        },
        openAi() {
            this.dismiss();
            window.location.href = '{{ route('ai.index') }}';
        }
     }"
     x-show="showModal"
     x-cloak
     @keydown.escape.window="dismiss()"
     class="fixed inset-0 z-[99998] flex items-center justify-center p-4 sm:p-6"
     role="dialog"
     aria-modal="true">

    {{-- Backdrop with soft blur --}}
    <div x-show="showModal"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="dismiss()"
         class="fixed inset-0 bg-slate-950/70 backdrop-blur-md transition-opacity"></div>

    {{-- Modal Card --}}
    <div x-show="showModal"
         x-transition:enter="transition cubic-bezier(0.16, 1, 0.3, 1) duration-400 transform"
         x-transition:enter-start="opacity-0 translate-y-8 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-6 scale-95"
         class="relative w-full max-w-sm sm:max-w-md rounded-3xl bg-white/95 backdrop-blur-xl p-6 sm:p-8 text-center shadow-[0_25px_70px_-15px_rgba(0,12,70,0.35)] ring-1 ring-blue-500/15 border border-white overflow-hidden z-10">

        {{-- Background High-Tech Aura Effects --}}
        <div class="absolute -top-20 -right-20 w-44 h-44 rounded-full bg-blue-500/15 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-20 -left-20 w-44 h-44 rounded-full bg-amber-400/15 blur-3xl pointer-events-none"></div>
        <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-transparent via-[#0453cd] to-transparent opacity-80"></div>

        {{-- Close Button --}}
        <button type="button"
                @click="dismiss()"
                class="absolute top-4 right-4 p-2 text-slate-400 hover:text-slate-700 rounded-full hover:bg-slate-100/80 transition-colors"
                aria-label="Tutup modal">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        {{-- Content --}}
        <div class="relative z-10 space-y-5">
            {{-- Robot Mascot with Glowing Tech Frame --}}
            <div class="relative inline-flex items-center justify-center mx-auto">
                <div class="absolute inset-0 bg-gradient-to-tr from-[#0453cd]/20 to-amber-400/20 rounded-3xl blur-md"></div>
                <div class="relative p-2 bg-gradient-to-b from-white to-blue-50/80 rounded-3xl shadow-lg border border-blue-100">
                    <img src="{{ asset('images/ai-robot.png') }}"
                         alt="Robot Asisten AI HIMSI"
                         class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl object-contain">
                    <div class="absolute -bottom-1 -right-1 flex h-6 w-6 items-center justify-center rounded-full bg-gradient-to-tr from-[#001b79] to-[#0453cd] text-amber-400 shadow-md ring-2 ring-white">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Tech Badge & Headline --}}
            <div class="space-y-2">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 border border-blue-200/60 text-[#001b79] text-[11px] font-black tracking-wider uppercase">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-90"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-400"></span>
                    </span>
                    <span>HIMSI INTELLIGENCE</span>
                </div>
                <h3 class="text-xl sm:text-2xl font-black text-[#000c46] tracking-tight">
                    Temui Asisten AI HIMSI
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed max-w-xs mx-auto">
                    Kini Anda dapat berkonsultasi seputar kepengurusan, cabang, dan agenda HIMSI UBSI secara instan 24/7.
                </p>
            </div>

            {{-- Quick Tech Features Mini Pills --}}
            <div class="flex items-center justify-center gap-2 pt-0.5">
                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-slate-100/90 text-slate-700 text-[11px] font-semibold border border-slate-200/60">
                    <svg class="w-3 h-3 text-[#0453cd]" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
                    </svg>
                    Respon Cepat 24/7
                </span>
                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-slate-100/90 text-slate-700 text-[11px] font-semibold border border-slate-200/60">
                    <svg class="w-3 h-3 text-[#0453cd]" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    Data Resmi Terverifikasi
                </span>
            </div>

            {{-- Action Buttons --}}
            <div class="pt-2 space-y-2">
                <button type="button"
                        @click="openAi()"
                        class="w-full py-3.5 px-5 rounded-2xl bg-gradient-to-r from-[#000c46] via-[#001b79] to-[#0453cd] hover:brightness-110 text-white text-sm font-extrabold shadow-lg shadow-blue-900/25 hover:shadow-blue-900/35 transition-all transform hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2 group border border-white/20">
                    <span>Mulai Percakapan AI</span>
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>

                <button type="button"
                        @click="dismiss()"
                        class="text-xs font-semibold text-slate-400 hover:text-slate-700 transition-colors py-1 block mx-auto">
                    Mungkin Nanti
                </button>
            </div>
        </div>

    </div>
</div>
