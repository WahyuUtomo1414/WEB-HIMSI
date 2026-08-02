@props(['hero'])

<section class="relative bg-[#000c46] min-h-screen flex items-center overflow-hidden isolate pt-20">
    <!-- Background Video -->
    <div class="absolute inset-0 -z-20">
        <video class="h-full w-full object-cover opacity-60" autoplay muted loop playsinline poster="/images/placeholder.svg">
            <source src="{{ asset('video/web_himsi.mp4') }}" type="video/mp4">
        </video>
    </div>
    
    <!-- Dark Primary Overlay -->
    <div class="absolute inset-0 -z-10 bg-slate-950/75"></div>

    <div class="mx-auto max-w-7xl px-6 lg:px-8 relative z-10 w-full"
         x-data="{
            phrases: ['Teknologi', 'Kolaborasi', 'Inovasi', 'Teknologi, Kolaborasi Dan Inovasi'],
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

                let speed = this.isDeleting ? 40 : 90;

                if (!this.isDeleting && this.currentText === fullPhrase) {
                    speed = 1800;
                    this.isDeleting = true;
                } else if (this.isDeleting && this.currentText === '') {
                    this.isDeleting = false;
                    this.currentPhraseIndex = (this.currentPhraseIndex + 1) % this.phrases.length;
                    speed = 400;
                }

                setTimeout(() => this.type(), speed);
            }
         }"
         x-init="type()">

        <div class="max-w-3xl py-20 lg:py-28 space-y-6">

            <!-- Main Headline H1 -->
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-white leading-tight">
                <!-- Baris 1: HIMSI UBSI dengan efek stabilo dari kiri ke kanan -->
                <span class="animate-stabilo font-bold px-2.5 py-0.5 my-1">HIMSI UBSI</span>
                <br>
                <!-- Baris 2: Teknologi, Kolaborasi Dan Inovasi dengan efek ketik warna putih -->
                <span class="text-white" x-text="currentText">Teknologi, Kolaborasi Dan Inovasi</span><span class="animate-pulse text-white">|</span>
            </h1>

            <!-- Baris 3: Paragraf pendukung (Teks biasa tanpa efek) -->
            <p class="text-base sm:text-lg lg:text-xl text-slate-300 leading-relaxed font-normal max-w-xl">
                Persiapkan langkah mu menuju masa depan, dan kontribusi nyata bersama kami.
            </p>

            <!-- Action Buttons -->
            <div class="pt-4 flex flex-col sm:flex-row items-center gap-4">
                <a href="{{ route('contact.index') }}"
                    class="w-full sm:w-auto inline-flex justify-center items-center rounded-xl bg-[#0453cd] px-7 py-3.5 text-base font-bold text-white shadow-lg hover:bg-[#356ee7] transition-all">
                    Hubungi Kami <svg class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
                <a href="{{ route('about.index') }}"
                    class="w-full sm:w-auto inline-flex justify-center items-center rounded-xl bg-white px-7 py-3.5 text-base font-bold text-slate-900 shadow-lg hover:bg-slate-100 transition-all">
                    Tentang Kami
                </a>
            </div>

        </div>

    </div>
</section>
