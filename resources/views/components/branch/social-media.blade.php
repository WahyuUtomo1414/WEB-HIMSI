@props(['branch'])

<section class="rounded-3xl p-6 sm:p-8 bg-white border border-[#c5c5d4]/60 shadow-[0_4px_20px_rgba(0,27,121,0.04)] space-y-6">
    <div class="space-y-1">
        <h3 class="text-xl font-bold text-[#000c46]">Komunikasi & Media Sosial Cabang</h3>
        <p class="text-xs text-[#454652]">Kanal komunikasi resmi dan akun jejaring sosial {{ $branch['name'] }}</p>
    </div>

    @if (!empty($branch['sosial_media']) && count($branch['sosial_media']) > 0)
        <div class="pt-2">
            <x-common.social-icons :socials="$branch['sosial_media']" size="lg" />
        </div>
    @endif
</section>
