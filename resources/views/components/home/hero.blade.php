@props(['hero'])

<section class="relative min-h-screen flex items-center overflow-hidden isolate pt-20 pb-12"
         x-data="{
            phrases: ['Sistem Informasi'],
            currentPhraseIndex: 0,
            currentText: '',
            isDeleting: false,
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
            }
         }"
         x-init="type()">
    <!-- Background Video (Full visibility & sharp contrast with Forced Muted Autoplay) -->
    <div class="absolute inset-0 -z-20 pointer-events-none">
        <video x-ref="heroVideo"
               id="heroVideoEl"
               class="h-full w-full object-cover opacity-90 scale-105 pointer-events-none" 
               autoplay 
               muted="muted" 
               loop 
               playsinline
               webkit-playsinline
               preload="auto"
               tabindex="-1"
               controlslist="nodownload nofullscreen noremoteplayback"
               x-init="$nextTick(() => { 
                   const v = $refs.heroVideo;
                   if (v) { 
                       v.muted = true; 
                       v.defaultMuted = true; 
                       const p = v.play();
                       if (p !== undefined) {
                           p.catch(() => {
                               v.muted = true;
                               v.play();
                           });
                       }
                   } 
               })"
               onloadeddata="this.muted=true; this.play().catch(() => {});"
               oncanplay="this.muted=true; this.play().catch(() => {});">
            <source src="{{ asset('video/web_himsi.mp4') }}" type="video/mp4">
        </video>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const playHeroVideo = function() {
                const v = document.getElementById('heroVideoEl');
                if (v && v.paused) {
                    v.muted = true;
                    v.defaultMuted = true;
                    v.play().catch(function() {});
                }
            };
            playHeroVideo();
            ['click', 'touchstart', 'scroll', 'mousemove'].forEach(function(evt) {
                window.addEventListener(evt, playHeroVideo, { once: true });
            });
        });
    </script>
    
    <!-- Subtle Side & Top Vignette Gradients for Legibility without Darkening Video -->
    <div class="absolute inset-0 -z-10 bg-gradient-to-r from-[#000c46]/85 via-[#000c46]/50 to-transparent"></div>
    <div class="absolute inset-0 -z-10 bg-gradient-to-t from-[#000c46]/90 via-transparent to-[#000c46]/40"></div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative z-10 w-full">

        <div class="max-w-3xl py-12 sm:py-20 lg:py-24 space-y-6 sm:space-y-7">

            <!-- Top Pill Badges -->
            <div class="flex flex-wrap items-center gap-3 pt-2">
                <span class="inline-flex items-center gap-2 rounded-full bg-amber-500/20 text-amber-300 border border-amber-500/40 px-4 py-1.5 text-xs font-extrabold backdrop-blur-md shadow-sm">
                    <span class="h-2 w-2 rounded-full bg-amber-400 animate-ping"></span>
                    <span>HIMSI UBSI</span>
                </span>
            </div>

            <!-- Main Headline H1 -->
            <div class="space-y-2">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight text-white leading-tight">
                    <span class="block">Himpunan Mahasiswa</span>
                    <span class="text-amber-400 block my-1 min-h-[1.2em]">
                        <span x-text="currentText">Sistem Informasi</span><span class="animate-pulse text-amber-400">|</span>
                    </span>
                </h1>
            </div>

            <!-- Supporting Paragraph -->
            <p class="text-sm sm:text-base lg:text-lg text-slate-200 leading-relaxed font-semibold max-w-xl">
                Teknologi, Kolaborasi, dan Inovasi. Persiapkan langkahmu menuju masa depan gemilang dan ciptakan kontribusi nyata bersama Himpunan Mahasiswa Sistem Informasi UBSI.
            </p>

            <!-- Action Buttons -->
            <div class="pt-3 flex flex-col sm:flex-row items-center gap-4">
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

</section>
