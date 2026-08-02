<x-layouts.public title="Beranda - HIMSI UBSI">

    {{-- 1. Hero Section --}}
    <x-home.hero :hero="$hero" />

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-24 py-12">

        {{-- 2. Count Section --}}
        <x-home.count :counts="$counts" />

        {{-- 3. Greeting Section (Sambutan) --}}
        <x-home.greeting :greeting="$greeting" />

        {{-- 4. List Division Section --}}
        <x-home.divisions :divisions="$divisions" />

        {{-- 5. List Cabang Section --}}
        <x-home.branches :branches="$branches" />

        {{-- 6. List Blog/Artikel Section --}}
        <x-home.blogs :blogs="$blogs" />

        {{-- 7. FAQ Section --}}
        <x-home.faq :faqs="$faqs" />

        {{-- 8. CTA Section --}}
        <x-common.cta-section />

    </div>

</x-layouts.public>
