@props(['hero'])

<section class="relative min-h-[92vh] sm:min-h-screen flex items-center overflow-hidden isolate pt-24 pb-16"
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
    <!-- Background Video (Full visibility & sharp contrast) -->
    <div class="absolute inset-0 -z-20">
        <video class="h-full w-full object-cover opacity-90 scale-105" autoplay muted loop playsinline poster="/images/placeholder.svg">
            <source src="{{ asset('video/web_himsi.mp4') }}" type="video/mp4">
        </video>
    </div>
    
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

    </div>

    <!-- Floating Animated WhatsApp Button (Bottom Right) -->
    <div class="fixed bottom-6 right-6 z-50">
        <a href="https://wa.me/628123456789" target="_blank" rel="noopener" 
           title="Hubungi Kami via WhatsApp"
           class="relative h-16 w-16 rounded-full bg-emerald-500 hover:bg-emerald-600 text-white flex items-center justify-center shadow-[0_0_25px_rgba(16,185,129,0.6)] hover:scale-110 transition-all duration-300 group">
            <!-- Pulsing outer ring animation -->
            <span class="absolute inset-0 rounded-full bg-emerald-400 animate-ping opacity-40"></span>
            
            <svg class="w-8 h-8 relative z-10 transform group-hover:rotate-12 transition-transform duration-300" fill="currentColor" viewBox="0 0 24 24">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
            </svg>
        </a>
    </div>
</section>
