@props(['blog'])

@if (!empty($blog['quotes']))
    <div class="relative rounded-3xl bg-gradient-to-br from-[#001b79]/5 via-[#f0f4ff] to-white p-6 sm:p-8 border-l-4 border-l-[#0453cd] border border-[#c5c5d4]/60 shadow-[0_4px_20px_rgba(0,27,121,0.04)] space-y-2 my-6">
        <svg class="w-8 h-8 text-[#0453cd]/40 mb-1" fill="currentColor" viewBox="0 0 24 24">
            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
        </svg>
        <p class="text-base sm:text-lg font-bold text-[#000c46] italic leading-relaxed">
            "{{ $blog['quotes'] }}"
        </p>
    </div>
@endif
