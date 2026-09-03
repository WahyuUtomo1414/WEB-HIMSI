<x-layouts.public title="Tentang Kami - HIMSI UBSI">

    {{-- 1. Hero Section --}}
    <x-about.hero :hero="$hero" />

    <div class="space-y-24 md:space-y-32 py-16 md:py-24">

        {{-- 2. About Section --}}
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-about.about :organization="$organization" />
        </div>

        {{-- 3. Vision and Mission Section --}}
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-about.vision-mission :organization="$organization" />
        </div>

        {{-- 4. Purpose Section --}}
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-about.purpose :organization="$organization" />
        </div>

        {{-- 5. Milestone Section (Full Width Section) --}}
        <x-about.milestone :milestones="$milestones" />

        {{-- 6. List Division Section --}}
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-about.divisions :divisions="$divisions" />
        </div>

        {{-- 7. CTA Section --}}
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-about.cta :organization="$organization" />
        </div>

    </div>

</x-layouts.public>
