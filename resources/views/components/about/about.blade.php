@props(['organization'])

<section class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
    <div class="lg:col-span-6 space-y-6">
        <x-common.section-header 
            badge="Mengenal HIMSI"
            title="{{ $organization['name'] }}" 
            align="left" />
        <p class="text-base text-[#454652] leading-relaxed">
            {{ $organization['description'] }}
        </p>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
            <div class="p-4 rounded-xl bg-white border border-slate-200">
                <span class="text-xs font-semibold text-[#454652] uppercase">Alamat Sekretariat</span>
                <p class="text-sm font-bold text-[#000c46] mt-1">{{ $organization['address'] }}</p>
            </div>
            <div class="p-4 rounded-xl bg-white border border-slate-200">
                <span class="text-xs font-semibold text-[#454652] uppercase">Email Resmi</span>
                <p class="text-sm font-bold text-[#0453cd] mt-1">{{ $organization['email'] }}</p>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="aspect-[16/10] overflow-hidden rounded-3xl border border-slate-200 shadow-xl">
            <img src="{{ $organization['thumbnail_url'] }}" alt="{{ $organization['name'] }}" class="h-full w-full object-cover">
        </div>
    </div>
</section>
