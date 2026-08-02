@props(['branch'])

<section class="card-nexus rounded-3xl p-8 bg-white space-y-6">
    <h3 class="text-xl font-bold text-[#000c46]">Komunikasi & Media Sosial Cabang</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        @if ($branch['grup_wa'])
            <a href="{{ $branch['grup_wa'] }}" target="_blank" rel="noopener" class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center justify-between text-emerald-800 font-bold hover:bg-emerald-100 transition">
                <span>Grup WhatsApp Cabang</span>
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
            </a>
        @endif

        @foreach ($branch['sosial_media'] as $medsos)
            <div class="p-4 rounded-xl bg-[#f0f4ff] border border-[#356ee7]/20 space-y-1">
                <span class="text-xs font-semibold text-[#454652] uppercase">{{ is_array($medsos) ? ($medsos['platform'] ?? 'Media Sosial') : 'Media Sosial' }}</span>
                <p class="text-sm font-bold text-[#001b79] truncate">
                    {{ is_array($medsos) ? ($medsos['url'] ?? ($medsos['value'] ?? implode(', ', $medsos))) : $medsos }}
                </p>
            </div>
        @endforeach
    </div>
</section>
