<x-layouts.public title="{{ $division['name'] }} - HIMSI UBSI">

    {{-- 1. Hero Section --}}
    <x-division.hero :division="$division" />

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-16 py-12 sm:py-16">

        {{-- 2. About & Thumbnail Section (Side-by-Side) --}}
        <x-division.about :division="$division" />

        {{-- 3. Job Description Section --}}
        <x-division.job-description :division="$division" />

        {{-- 4. CTA Section --}}
        <x-common.cta-section 
            title="Tertarik Berkolaborasi Dengan {{ $division['name'] }}?" 
            subtitle="Sampaikan pertanyaan atau ide program kerja Anda kepada pengurus divisi kami." />

    </div>

</x-layouts.public>

