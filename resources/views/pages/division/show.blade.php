<x-layouts.public title="{{ $division['name'] }} - HIMSI UBSI">

    {{-- 1. Hero Section --}}
    <x-division.hero :division="$division" />

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-20 py-16">

        {{-- 2. Image Section --}}
        <x-division.image :division="$division" />

        {{-- 3. About Section --}}
        <x-division.about :division="$division" />

        {{-- 4. Job Description Section --}}
        <x-division.job-description :division="$division" />

        {{-- 5. CTA Section --}}
        <x-common.cta-section 
            title="Tertarik Berkolaborasi Dengan {{ $division['name'] }}?" 
            subtitle="Sampaikan pertanyaan atau ide program kerja Anda kepada pengurus divisi kami." />

    </div>

</x-layouts.public>
