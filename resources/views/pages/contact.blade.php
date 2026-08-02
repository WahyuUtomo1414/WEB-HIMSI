<x-layouts.public title="Kontak - HIMSI UBSI">

    {{-- 1. Hero Section --}}
    <x-contact.hero :hero="$hero" />

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            {{-- 2. Left Section: Sosial Media & Informasi Kontak --}}
            <div class="lg:col-span-5">
                <x-contact.left-info :organization="$organization" />
            </div>

            {{-- 3. Right Section: Form Kontak --}}
            <div class="lg:col-span-7">
                <x-contact.right-form />
            </div>

        </div>
    </div>

</x-layouts.public>
