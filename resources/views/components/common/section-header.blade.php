@props([
    'badge' => null,
    'title' => '',
    'subtitle' => null,
    'align' => 'center'
])

<div class="space-y-3 {{ $align === 'center' ? 'text-center mx-auto max-w-3xl' : 'text-left' }}">
    @if ($badge)
        <span class="inline-flex items-center gap-1.5 rounded-full bg-[#f0f4ff] px-3.5 py-1 text-xs font-semibold text-[#0453cd] border border-[#356ee7]/20">
            {{ $badge }}
        </span>
    @endif
    <h2 class="text-3xl font-extrabold text-[#000c46] tracking-tight sm:text-4xl">
        {!! $title !!}
    </h2>
    @if ($subtitle)
        <p class="text-base text-[#454652] sm:text-lg leading-relaxed">
            {{ $subtitle }}
        </p>
    @endif
</div>
