<x-layouts.public title="Beranda - HIMSI UBSI">

    {{-- 1. Hero Section --}}
    <x-home.hero :hero="$hero" />

    <div class="space-y-8 sm:space-y-12 lg:space-y-16 py-8 sm:py-12 lg:py-14">

        {{-- 2. Count Section --}}
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-home.count :counts="$counts" />
        </div>

        {{-- 3. Greeting Section (Sambutan) --}}
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-home.greeting :greeting="$greeting" />
        </div>

        {{-- 4. List Division Section (Full Width Section) --}}
        <x-home.divisions :divisions="$divisions" />

        {{-- 5. List Cabang Section --}}
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-home.branches :branches="$branches" />
        </div>

        {{-- 6. List Blog/Artikel Section (Full Width Section) --}}
        <x-home.blogs :blogs="$blogs" />

        {{-- 7. FAQ Section --}}
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-home.faq :faqs="$faqs" />
        </div>

        {{-- 8. CTA Section --}}
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-common.cta-section />
        </div>

    </div>

</x-layouts.public>
