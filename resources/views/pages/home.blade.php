<x-layouts.public title="Beranda - HIMSI UBSI">

    {{-- Splash Screen Loading Video (Hanya di Halaman Home) --}}
    <x-common.splash-screen />

    {{-- AI Assistant Announcement Modal (Option 1) --}}
    <x-home.ai-announcement-modal />

    {{-- 1. Hero Section (Dark Sinematik) --}}
    <x-home.hero :hero="$hero" />

    {{-- 2. Pillars of Excellence (BG: Soft Tint #f0f4ff) --}}
    <x-home.pillars />

    {{-- 3. Count Section (BG: Pure White #ffffff) --}}
    <x-home.count :counts="$counts" />

    {{-- 4. Greeting Section (BG: Soft Tint #f0f4ff) --}}
    <x-home.greeting :greeting="$greeting" />

    {{-- 5. Interactive Division Spotlight Section (BG: Pure White #ffffff) --}}
    <x-home.division-spotlight :divisions="$divisions" />

    {{-- 6. List Cabang Section (BG: Soft Tint #f0f4ff) --}}
    <x-home.branches :branches="$branches" />

    {{-- 7. List Blog/Artikel Section (BG: Pure White #ffffff) --}}
    <x-home.blogs :blogs="$blogs" />

    {{-- 8. Dokumentasi & Galeri Kegiatan (BG: Soft Tint #f0f4ff) --}}
    <x-home.activities-gallery :row1-loop="$activities_row1_loop" :row2-loop="$activities_row2_loop" />

    {{-- 9. FAQ Section (BG: Pure White #ffffff) --}}
    <x-home.faq :faqs="$faqs" />

    {{-- 10. CTA Section (BG: Pure White with Dark Accent Card) --}}
    <section class="w-full bg-white py-12 sm:py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-common.cta-section />
        </div>
    </section>

</x-layouts.public>
