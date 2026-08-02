@props(['blog'])

@if ($blog['quotes'])
    <div class="rounded-2xl bg-[#f0f4ff] p-6 border-l-4 border-[#001b79] text-[#000c46] font-semibold text-lg italic shadow-xs">
        "{{ $blog['quotes'] }}"
    </div>
@endif
