@props(['greeting'])

@if ($greeting)
    <section class="w-full py-12 sm:py-16 lg:py-20 bg-[#f0f4ff]/70 border-b border-[#c5c5d4]/40">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl bg-white p-8 md:p-12 border border-[#c5c5d4]/60 shadow-[0_4px_20px_rgba(0,27,121,0.05)]">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
                    <div class="md:col-span-4 text-center">
                        <div class="h-40 w-40 mx-auto rounded-full overflow-hidden border-4 border-[#f0f4ff] shadow-lg relative">
                            <x-common.image :src="$greeting['image_url']" :alt="$greeting['name']" class="h-full w-full object-cover" />
                        </div>
                        <h3 class="mt-4 text-xl font-bold text-[#000c46]">{{ $greeting['name'] }}</h3>
                        <p class="text-xs font-semibold text-[#0453cd] uppercase tracking-wider">{{ $greeting['position'] }}</p>
                    </div>
                    <div class="md:col-span-8 space-y-4">
                        <x-common.section-header title="Sambutan Pengurus" align="left" />
                        <div class="text-base text-[#454652] leading-relaxed italic relative pl-4 border-l-4 border-[#001b79] prose prose-sm max-w-none">
                            {!! $greeting['body'] !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
