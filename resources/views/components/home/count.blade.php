@props(['counts'])

@if (count($counts) > 0)
    <section class="rounded-3xl bg-white p-8 md:p-12 border border-[#c5c5d4]/60 shadow-[0_4px_20px_rgba(0,27,121,0.05)]">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-x-0 md:divide-x divide-slate-100">
            @foreach ($counts as $count)
                <div class="space-y-2 p-2">
                    <div class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#001b79] tracking-tight">
                        {{ $count['digit'] }}
                    </div>
                    <div class="text-xs sm:text-sm font-semibold uppercase tracking-wider text-[#454652]">
                        {{ $count['name'] }}
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endif
