@props(['branch'])

<section class="rounded-3xl p-6 sm:p-8 bg-white border border-[#c5c5d4]/60 shadow-[0_4px_20px_rgba(0,27,121,0.04)] space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="space-y-1">
            <h3 class="text-xl font-bold text-[#000c46]">Komunikasi & Media Sosial Cabang</h3>
            <p class="text-xs text-[#454652]">Kanal komunikasi resmi dan akun jejaring sosial {{ $branch['name'] }}</p>
        </div>

        @if (!empty($branch['grup_wa']))
            <a href="{{ $branch['grup_wa'] }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 px-5 py-2.5 text-xs font-bold text-white transition-all shadow-sm hover:shadow-md shrink-0">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                </svg>
                <span>Gabung Grup WhatsApp</span>
            </a>
        @endif
    </div>

    @if (!empty($branch['sosial_media']) && count($branch['sosial_media']) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 pt-2">
            @foreach ($branch['sosial_media'] as $medsos)
                @php
                    $platform = is_array($medsos) ? ($medsos['platform'] ?? 'Media Sosial') : 'Media Sosial';
                    $url = is_array($medsos) ? ($medsos['url'] ?? ($medsos['value'] ?? implode(', ', $medsos))) : $medsos;
                @endphp
                <div class="group p-4 rounded-2xl bg-white border border-[#c5c5d4]/60 shadow-[0_4px_16px_rgba(0,27,121,0.04)] hover:shadow-[0_8px_24px_rgba(0,27,121,0.12)] hover:border-[#0453cd]/40 transition-all duration-300 flex items-center justify-between gap-3">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="h-10 w-10 rounded-xl bg-[#001b79]/5 text-[#0453cd] group-hover:bg-[#001b79] group-hover:text-white transition-all flex items-center justify-center shrink-0 shadow-xs">
                            @if (str_contains(strtolower($platform), 'instagram'))
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                </svg>
                            @elseif (str_contains(strtolower($platform), 'email') || str_contains(strtolower($url), '@'))
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            @elseif (str_contains(strtolower($platform), 'youtube'))
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path>
                                    <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon>
                                </svg>
                            @else
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="2" y1="12" x2="22" y2="12"></line>
                                    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                </svg>
                            @endif
                        </div>
                        <div class="min-w-0 space-y-0.5">
                            <span class="block text-[11px] font-bold text-[#454652] uppercase tracking-wider">{{ $platform }}</span>
                            <p class="text-xs font-bold text-[#000c46] group-hover:text-[#0453cd] transition-colors truncate">
                                {{ $url }}
                            </p>
                        </div>
                    </div>
                    <svg class="w-3.5 h-3.5 text-slate-300 group-hover:text-[#0453cd] group-hover:translate-x-0.5 transition-all shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                    </svg>
                </div>
            @endforeach
        </div>
    @endif
</section>
