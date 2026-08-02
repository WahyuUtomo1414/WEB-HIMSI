@props(['branch'])

<section class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
    <div class="lg:col-span-7 space-y-6">
        <x-common.section-header 
            badge="Profil Cabang"
            title="Tentang {{ $branch['name'] }}" 
            align="left" />
        <p class="text-base text-[#454652] leading-relaxed">
            {{ $branch['description'] }}
        </p>
    </div>
    <div class="lg:col-span-5">
        <div class="aspect-[4/3] overflow-hidden rounded-3xl border border-slate-200 shadow-xl">
            <img src="{{ $branch['thumbnail_url'] }}" alt="{{ $branch['name'] }}" class="h-full w-full object-cover">
        </div>
    </div>
</section>
