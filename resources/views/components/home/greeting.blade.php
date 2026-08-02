@props(['greeting'])

@if ($greeting)
    <section class="rounded-3xl bg-[#f0f4ff]/70 p-8 md:p-12 border border-[#356ee7]/20">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
            <div class="md:col-span-4 text-center">
                <div class="h-40 w-40 mx-auto rounded-full overflow-hidden border-4 border-white shadow-lg">
                    <img src="{{ $greeting['image_url'] }}" alt="{{ $greeting['name'] }}" class="h-full w-full object-cover">
                </div>
                <h3 class="mt-4 text-xl font-bold text-[#000c46]">{{ $greeting['name'] }}</h3>
                <p class="text-xs font-semibold text-[#0453cd] uppercase tracking-wider">{{ $greeting['position'] }}</p>
            </div>
            <div class="md:col-span-8 space-y-4">
                <x-common.section-header title="Sambutan Pengurus" align="left" />
                <div class="text-base text-[#454652] leading-relaxed italic relative pl-4 border-l-4 border-[#001b79]">
                    "{{ $greeting['body'] }}"
                </div>
            </div>
        </div>
    </section>
@endif
