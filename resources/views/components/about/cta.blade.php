@props(['organization'])

<section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#000c46] via-[#001b79] to-[#0453cd] px-8 py-14 md:px-16 md:py-20 text-white shadow-[0_8px_40px_rgba(0,27,121,0.18)]">

    <!-- Background Decorations -->
    <div class="pointer-events-none absolute -right-16 -top-16 h-64 w-64 rounded-full bg-[#356ee7]/25 blur-3xl"></div>
    <div class="pointer-events-none absolute -bottom-16 -left-16 h-64 w-64 rounded-full bg-[#0453cd]/25 blur-3xl"></div>

    <div class="relative z-10 flex flex-col items-center gap-8 text-center md:flex-row md:items-center md:justify-between md:text-left">

        <!-- Text -->
        <div class="max-w-xl space-y-3">
            <span class="inline-flex items-center rounded-full border border-white/20 bg-white/10 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-white backdrop-blur-xs">
                Bergabung Sekarang
            </span>
            <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                Siap Menjadi Bagian dari HIMSI?
            </h2>
            <p class="text-base leading-relaxed text-slate-300">
                Jadilah bagian dari komunitas mahasiswa Sistem Informasi UBSI yang aktif, kolaboratif, dan berdampak. Buka peluang baru bersama kami.
            </p>
        </div>

        <!-- Buttons -->
        <div class="flex shrink-0 flex-col gap-3 sm:flex-row">
            <a href="{{ route('recruitment.index') }}"
               class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#f59e0b] px-7 py-3.5 text-sm font-bold text-[#000c46] shadow-md transition hover:bg-amber-400 hover:shadow-lg active:scale-95">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3M13.5 4.5 21 12l-7.5 7.5M3 12h9" />
                </svg>
                Daftar Rekrutmen
            </a>
            <a href="{{ route('contact.index') }}"
               class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/30 bg-white/10 px-7 py-3.5 text-sm font-bold text-white backdrop-blur-xs transition hover:bg-white/20 active:scale-95">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                </svg>
                Hubungi Kami
            </a>
        </div>

    </div>
</section>
