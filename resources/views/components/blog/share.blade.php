@props(['blog'])

<div class="rounded-3xl p-6 sm:p-8 bg-white border border-[#c5c5d4]/60 shadow-[0_4px_20px_rgba(0,27,121,0.04)] space-y-5">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="space-y-1">
            <h4 class="text-lg font-bold text-[#000c46]">Media Sosial Resmi Organisasi</h4>
            <p class="text-xs text-[#454652]">Ikuti kanal resmi HIMSI UBSI untuk kabar kegiatan dan informasi terkini</p>
        </div>
        @php
            $orgData = \App\Models\Organization::query()->where('active', true)->latest()->first();
        @endphp
        <div class="flex items-center gap-2">
            <x-common.social-icons :socials="$orgData?->sosial_media" size="md" />
        </div>
    </div>
</div>
