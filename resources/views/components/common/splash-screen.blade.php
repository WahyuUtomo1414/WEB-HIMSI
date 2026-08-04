<div x-data="{
        showSplash: true,
        fadeOut: false,
        init() {
            this.$nextTick(() => {
                if (this.$refs.splashVideo) {
                    this.$refs.splashVideo.muted = true;
                    const promise = this.$refs.splashVideo.play();
                    if (promise !== undefined) {
                        promise.catch(error => {
                            console.log('Autoplay handled');
                        });
                    }
                }
            });

            setTimeout(() => {
                this.dismiss();
            }, 3500);
        },
        dismiss() {
            if (this.fadeOut) return;
            this.fadeOut = true;
            setTimeout(() => {
                this.showSplash = false;
            }, 650);
        }
     }"
     x-show="showSplash"
     :class="{ 'opacity-0 pointer-events-none': fadeOut }"
     class="fixed inset-0 z-[99999] bg-[#000c46] flex items-end justify-center overflow-hidden transition-opacity duration-700 ease-in-out isolate">
    
    <!-- Background Clarion Video Intro (Forced Muted Autoplay) -->
    <div class="absolute inset-0 -z-10 pointer-events-none">
        <video x-ref="splashVideo" 
               class="h-full w-full object-cover opacity-90 scale-105 pointer-events-none" 
               autoplay 
               muted 
               loop
               playsinline 
               webkit-playsinline
               tabindex="-1"
               controlslist="nodownload nofullscreen noremoteplayback"
               @ended="dismiss()">
            <source src="{{ asset('video/clarion.mp4') }}" type="video/mp4">
        </video>
    </div>

    <!-- Subtle Bottom Vignette Gradient for Text Contrast -->
    <div class="absolute inset-0 -z-10 bg-gradient-to-t from-[#000c46]/90 via-transparent to-transparent pointer-events-none"></div>

    <!-- Bottom Content: Animated Loading Text & Progress Line (Positioned Lower) -->
    <div class="relative z-10 pb-16 sm:pb-20 flex flex-col items-center justify-center space-y-3 text-center px-4 pointer-events-none">
        <p class="text-xs sm:text-sm font-extrabold text-amber-400 uppercase tracking-[0.25em] animate-pulse">
            MEMUAT DATA...
        </p>

        <!-- Minimalist Loading Progress Line -->
        <div class="w-48 sm:w-64 h-1 rounded-full bg-white/20 overflow-hidden relative">
            <div class="h-full bg-gradient-to-r from-amber-400 via-[#356ee7] to-amber-400 rounded-full animate-[loading_2.5s_ease-in-out_infinite]"></div>
        </div>
    </div>
</div>

<style>
    video::-webkit-media-controls,
    video::-webkit-media-controls-start-playback-button,
    video::-webkit-media-controls-play-button,
    video::-webkit-media-controls-overlay-play-button {
        display: none !important;
        -webkit-appearance: none !important;
        opacity: 0 !important;
    }
    @keyframes loading {
        0% { transform: translateX(-100%); }
        50% { transform: translateX(0%); }
        100% { transform: translateX(100%); }
    }
</style>
