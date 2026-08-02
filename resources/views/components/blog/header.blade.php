@props(['blog'])

<header class="space-y-4 text-center">
    <div class="flex items-center justify-center gap-2 text-xs font-semibold">
        <span class="rounded-full bg-[#f0f4ff] px-3 py-1 text-[#0453cd] border border-[#356ee7]/20">
            {{ $blog['category_name'] }}
        </span>
        <span class="text-slate-400">•</span>
        <span class="text-[#454652]">{{ $blog['formatted_date'] }}</span>
        <span class="text-slate-400">•</span>
        <span class="text-[#000c46]">{{ $blog['branch_name'] }}</span>
    </div>
    <h1 class="text-3xl font-extrabold text-[#000c46] tracking-tight sm:text-4xl md:text-5xl leading-tight">
        {{ $blog['title'] }}
    </h1>
</header>
