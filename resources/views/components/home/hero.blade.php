@props(['hero'])

<section class="relative min-h-screen flex items-center overflow-hidden isolate pt-20 pb-12"
    x-data="{
        phrases: ['Sistem Informasi'],
        currentPhraseIndex: 0,
        currentText: '',
        isDeleting: false,
        videoPlaying: false,
        type() {
            const fullPhrase = this.phrases[this.currentPhraseIndex];
            if (this.isDeleting) {
                this.currentText = fullPhrase.substring(0, this.currentText.length - 1);
            } else {
                this.currentText = fullPhrase.substring(0, this.currentText.length + 1);
            }
            let speed = this.isDeleting ? 50 : 100;
            if (!this.isDeleting && this.currentText === fullPhrase) {
                speed = 2500;
                this.isDeleting = true;
            } else if (this.isDeleting && this.currentText === '') {
                this.isDeleting = false;
                this.currentPhraseIndex = (this.currentPhraseIndex + 1) % this.phrases.length;
                speed = 500;
            }
            setTimeout(() => this.type(), speed);
        },
        initVideo() {
            const v = this.$refs.heroVideo;
            if (!v) return;
            v.muted = true;
            v.defaultMuted = true;
            v.addEventListener('play',  () => { this.videoPlaying = true; });
            v.addEventListener('pause', () => { this.videoPlaying = false; });
            v.addEventListener('ended', () => { this.videoPlaying = false; });
            const p = v.play();
            if (p !== undefined) {
                p.then(() => { this.videoPlaying = true; }).catch(() => { this.videoPlaying = false; });
            }
        },
        toggleVideo() {
            const v = this.$refs.heroVideo;
            if (!v) return;
            if (v.paused) {
                v.play().then(() => { this.videoPlaying = true; }).catch(() => {});
            } else {
                v.pause();
            }
        }
    }"
    x-init="type(); $nextTick(() => initVideo())">

    <!-- Background Video -->
    <div class="absolute inset-0 -z-20">
        <video x-ref="heroVideo"
            class="h-full w-full object-cover opacity-90 scale-105"
            autoplay muted loop playsinline
            webkit-playsinline
            preload="auto"
            controlslist="nodownload nofullscreen noremoteplayback"
            tabindex="-1"
            style="pointer-events:none">
            <source src="{{ asset('video/web_himsi5.mp4') }}" type="video/mp4">
        </video>
    </div>

    <!-- Vignette -->
    <div class="absolute inset-0 -z-10 bg-gradient-to-r from-[#000c46]/85 via-[#000c46]/50 to-transparent"></div>
    <div class="absolute inset-0 -z-10 bg-gradient-to-t from-[#000c46]/90 via-transparent to-[#000c46]/40"></div>

    <!-- Hero Content -->
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative z-10 w-full">
        <div class="max-w-3xl py-12 sm:py-20 lg:py-24 space-y-6 sm:space-y-7">

            <!-- Badge -->
            <div class="flex flex-wrap items-center gap-3 pt-2">
                <span class="inline-flex items-center gap-2 rounded-full bg-amber-500/20 text-amber-300 border border-amber-500/40 px-4 py-1.5 text-xs font-extrabold backdrop-blur-md shadow-sm">
                    <span class="h-2 w-2 rounded-full bg-amber-400 animate-ping"></span>
                    <span>HIMSI UBSI</span>
                </span>
            </div>

            <!-- Headline -->
            <div class="space-y-2">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight text-white leading-[1.15]">
                    <span class="block">Himpunan Mahasiswa</span>
                    <span class="text-amber-400 block my-1 min-h-[1.25em]">
                        <span x-text="currentText">Sistem Informasi</span><span class="animate-pulse text-amber-400">|</span>
                    </span>
                </h1>
            </div>

            <!-- Supporting Copy -->
            <p class="text-base sm:text-lg lg:text-xl text-slate-200 leading-relaxed font-medium max-w-2xl drop-shadow-sm">
                Persiapkan langkahmu menuju masa depan gemilang dan ciptakan
                kontribusi nyata bersama Himpunan Mahasiswa Sistem Informasi UBSI.
            </p>

            <!-- Feature Badges -->
            <div class="flex flex-wrap items-center gap-3 text-xs sm:text-sm font-semibold text-slate-200 pt-1">
                <span class="inline-flex items-center gap-2 rounded-xl bg-white/10 px-4 py-2 border border-white/15 backdrop-blur-md shadow-sm">
                    <svg class="w-4 h-4 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                    </svg>
                    Teknologi
                </span>
                <span class="inline-flex items-center gap-2 rounded-xl bg-white/10 px-4 py-2 border border-white/15 backdrop-blur-md shadow-sm">
                    <svg class="w-4 h-4 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Kolaborasi
                </span>
                <span class="inline-flex items-center gap-2 rounded-xl bg-white/10 px-4 py-2 border border-white/15 backdrop-blur-md shadow-sm">
                    <svg class="w-4 h-4 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    Inovasi
                </span>
            </div>

            <!-- CTA Buttons -->
            <div class="pt-2 flex flex-col sm:flex-row items-center gap-4">
                <a href="{{ route('contact.index') }}"
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 rounded-full bg-amber-500 hover:bg-amber-400 text-slate-950 px-8 py-4 text-sm font-extrabold shadow-xl hover:shadow-amber-500/30 transition-all duration-300 hover:scale-105 group">
                    <span>Hubungi Kami</span>
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
                <a href="{{ route('about.index') }}"
                   class="w-full sm:w-auto inline-flex items-center justify-center rounded-full bg-white/15 hover:bg-white/25 text-white border border-white/25 px-8 py-4 text-sm font-extrabold backdrop-blur-md shadow-lg transition-all duration-300 hover:scale-105">
                    <span>Tentang Kami</span>
                </a>
            </div>

        </div>
    </div>

    <!-- Play / Pause Button — bottom left -->
    <div class="absolute bottom-6 left-4 sm:left-6 z-20">
        <button @click="toggleVideo()"
            class="inline-flex items-center gap-2 rounded-full bg-black/40 hover:bg-black/60 border border-white/20 backdrop-blur-md px-4 py-2.5 text-white text-xs font-semibold transition-all duration-200 select-none"
            :aria-label="videoPlaying ? 'Pause video' : 'Play video'">

            <!-- Play icon -->
            <svg x-show="!videoPlaying" class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                <path d="M8 5v14l11-7z"/>
            </svg>
            <!-- Pause icon -->
            <svg x-show="videoPlaying" class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/>
            </svg>

            <span x-text="videoPlaying ? 'Pause' : 'Play Video'"></span>
        </button>
    </div>

</section>
