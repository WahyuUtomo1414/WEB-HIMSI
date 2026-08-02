@props(['person'])

@php
    $hasPhoto = !empty($person['image_url']) && $person['image_url'] !== '/images/placeholder.svg';
@endphp

<div class="group rounded-2xl bg-white border border-[#c5c5d4]/60 shadow-[0_4px_16px_rgba(0,27,121,0.04)] hover:shadow-[0_12px_32px_rgba(0,27,121,0.12)] hover:border-[#0453cd]/40 transition-all duration-300 overflow-hidden flex flex-col justify-between h-full">
    <!-- Full-bleed Photo Container -->
    <div class="h-64 sm:h-72 w-full overflow-hidden bg-[#f0f4ff]/80 relative flex items-center justify-center group-hover:bg-[#f0f4ff] transition-colors">
        @if ($hasPhoto)
            <img src="{{ $person['image_url'] }}" alt="{{ $person['name'] }}" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500">
        @else
            <!-- Default User Icon Fallback -->
            <div class="flex flex-col items-center justify-center gap-2 text-[#001b79]/40 group-hover:text-[#0453cd] group-hover:scale-105 transition-all duration-300">
                <div class="h-20 w-20 rounded-full bg-[#001b79]/10 p-4 flex items-center justify-center shadow-xs">
                    <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                    </svg>
                </div>
                <span class="text-[11px] font-bold tracking-wider uppercase text-slate-400">Pengurus HIMSI</span>
            </div>
        @endif
    </div>

    <!-- Member Info Text Under Photo -->
    <div class="p-5 space-y-3 text-center bg-white flex-1 flex flex-col justify-between">
        <div class="space-y-1.5">
            <h4 class="text-lg font-bold text-[#000c46] group-hover:text-[#0453cd] transition-colors leading-snug">
                {{ $person['name'] }}
            </h4>
            <p class="text-xs font-extrabold text-[#0453cd] uppercase tracking-wider">
                {{ $person['position'] }}
            </p>
        </div>

        <div class="pt-3 border-t border-slate-100 flex items-center justify-center">
            <span class="inline-block text-xs font-semibold text-[#454652] bg-[#f0f4ff] border border-[#356ee7]/20 rounded-full px-3 py-1">
                {{ $person['division_name'] }}
            </span>
        </div>
    </div>
</div>
