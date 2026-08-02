@props(['division'])

<section class="card-nexus rounded-3xl p-8 md:p-12 space-y-4">
    <x-common.section-header 
        badge="Deskripsi Peran"
        title="Tentang {{ $division['name'] }}" 
        align="left" />
    <p class="text-base text-[#454652] leading-relaxed">
        {{ $division['description'] }}
    </p>
</section>
