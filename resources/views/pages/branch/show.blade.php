<x-layouts.public title="{{ $branch['name'] }} - HIMSI UBSI">

    {{-- 1. Hero Section --}}
    <x-branch.hero 
        :title="$branch['name']" 
        :backLink="route('branch.index')" 
        :badge="'Sektor: ' . $branch['sektor']" 
        :location="$branch['location']" />

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-20 py-16">

        {{-- 2. About Section --}}
        <x-branch.about :branch="$branch" />

        {{-- 3. Sosial Media Section & WA Link --}}
        <x-branch.social-media :branch="$branch" />

        {{-- 4. Struktur Organisasi Section --}}
        <x-branch.structures :branch="$branch" :structures="$structures" />

        {{-- 5. CTA Section --}}
        <x-common.cta-section 
            title="Tertarik Bergabung Dengan {{ $branch['name'] }}?" 
            subtitle="Hubungi pengurus atau bergabunglah dalam grup WhatsApp resmi cabang kami." />

    </div>

</x-layouts.public>
