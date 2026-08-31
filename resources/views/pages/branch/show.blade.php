<x-layouts.public :title="$branch['name'] . ' - HIMSI UBSI'">

    {{-- 1. Hero Section --}}
    <x-branch.hero 
        :title="$branch['name']" 
        :backLink="route('branch.index')" 
        :badge="'Sektor: ' . $branch['sektor']" 
        :location="$branch['location']" />

    <div class="space-y-24 md:space-y-32 py-16 md:py-24">

        {{-- 2. About Section --}}
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-branch.about :branch="$branch" />
        </div>

        {{-- 3. Sosial Media Section & WA Link --}}
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-branch.social-media :branch="$branch" />
        </div>

        {{-- 4. Struktur Organisasi Section (Full Width Section) --}}
        <x-branch.structures :branch="$branch" :structures="$structures" />

        {{-- 5. CTA Section --}}
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-common.cta-section 
                :title="'Tertarik Bergabung Dengan ' . $branch['name'] . '?'" 
                subtitle="Hubungi pengurus atau bergabunglah dalam grup WhatsApp resmi cabang kami." />
        </div>

    </div>

</x-layouts.public>
