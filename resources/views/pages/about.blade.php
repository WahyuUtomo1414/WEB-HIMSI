<x-layouts.public title="Tentang Kami - HIMSI UBSI">

    {{-- 1. Hero Section --}}
    <x-about.hero :hero="$hero" />

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-24 py-16">

        {{-- 2. About Section --}}
        <x-about.about :organization="$organization" />

        {{-- 3. Vision and Mission Section --}}
        <x-about.vision-mission :organization="$organization" />

        {{-- 4. Purpose Section --}}
        <x-about.purpose :organization="$organization" />

        {{-- 5. Milestone Section --}}
        <x-about.milestone :milestones="$milestones" />

        {{-- 6. List Division Section --}}
        <x-about.divisions :divisions="$divisions" />

    </div>

</x-layouts.public>
