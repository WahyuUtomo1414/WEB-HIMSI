@props(['blog'])

<header class="space-y-4 text-center">
    <div class="flex items-center justify-center gap-2 text-xs font-semibold">
        <span class="rounded-full bg-white/10 px-3.5 py-1 text-white border border-white/20 backdrop-blur-xs">
            {{ $blog['category_name'] }}
        </span>
        <span class="text-slate-400">•</span>
        <span class="text-slate-200">{{ $blog['formatted_date'] }}</span>
        <span class="text-slate-400">•</span>
        <span class="text-white font-bold">{{ $blog['branch_name'] }}</span>
    </div>
    <h1 class="text-3xl font-extrabold text-white tracking-tight sm:text-4xl md:text-5xl leading-tight max-w-3xl mx-auto">
        {{ $blog['title'] }}
    </h1>
</header>
