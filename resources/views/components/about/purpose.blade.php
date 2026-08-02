@props(['organization'])

<section class="rounded-3xl bg-[#f0f4ff]/80 p-8 md:p-12 border border-[#356ee7]/20 space-y-4">
    <x-common.section-header 
        badge="Tujuan"
        title="Tujuan Pembentukan HIMSI" 
        align="left" />
    <p class="text-base text-[#454652] leading-relaxed">
        {{ $organization['purpose'] }}
    </p>
</section>
