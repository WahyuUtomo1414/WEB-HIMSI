<x-layouts.public title="Beranda - HIMSI UBSI">

    {{-- Splash Screen Loading Video (Hanya di Halaman Home) --}}
    <x-common.splash-screen />

    {{-- 1. Hero Section --}}
    <x-home.hero :hero="$hero" />

    {{-- 2. Pillars of Excellence (Pilar Keunggulan HIMSI) --}}
    <x-home.pillars />

    <div class="space-y-8 sm:space-y-12 lg:space-y-16 py-8 sm:py-12 lg:py-14">

        {{-- 3. Count Section --}}
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-home.count :counts="$counts" />
        </div>

        {{-- 4. Greeting Section (Sambutan) --}}
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-home.greeting :greeting="$greeting" />
        </div>

        {{-- 5. Interactive Division Spotlight Section (Full Width Showcase) --}}
        <x-home.division-spotlight :divisions="$divisions" />

        {{-- 6. List Cabang Section --}}
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-home.branches :branches="$branches" />
        </div>

        {{-- 7. List Blog/Artikel Section (Full Width Section) --}}
        <x-home.blogs :blogs="$blogs" />

        {{-- 8. FAQ Section --}}
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-home.faq :faqs="$faqs" />
        </div>

        {{-- 9. CTA Section --}}
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-common.cta-section />
        </div>

    </div>

</x-layouts.public>
