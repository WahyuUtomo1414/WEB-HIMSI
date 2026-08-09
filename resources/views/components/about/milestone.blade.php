@props(['milestones'])

<section class="w-full bg-[#eef4ff] py-16 sm:py-20 lg:py-28 border-y border-[#c5c5d4]/40">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-12 sm:space-y-16">
        
        <x-common.section-header 
            badge="Linimasa"
            title="Milestone & Sejarah" 
            subtitle="Jejak langkah dan perjalanan panjang HIMSI UBSI dari waktu ke waktu" />

        @if (count($milestones) > 0)
            <div class="relative max-w-5xl mx-auto py-4">
                <!-- Vertical Timeline Center Line -->
                <div class="absolute left-4 md:left-1/2 top-0 bottom-0 w-0.5 bg-[#001b79]/20 -translate-x-1/2"></div>

                <div class="space-y-12 sm:space-y-16">
                    @foreach ($milestones as $index => $milestone)
                        <div class="relative flex flex-col md:flex-row items-start md:items-center">
                            <!-- Circular Ring Node -->
                            <div class="absolute left-4 md:left-1/2 -translate-x-1/2 top-8 md:top-1/2 md:-translate-y-1/2 h-7 w-7 rounded-full border-4 border-[#0453cd] bg-white shadow-md z-20"></div>

                            <!-- Timeline Card Box -->
                            <div class="w-full pl-12 md:pl-0 {{ $index % 2 === 0 ? 'md:w-[46%] md:mr-auto md:pr-4' : 'md:w-[46%] md:ml-auto md:pl-4' }}">
                                <div class="group rounded-3xl bg-white p-6 sm:p-8 border border-[#c5c5d4]/60 shadow-[0_4px_20px_rgba(0,27,121,0.04)] hover:shadow-[0_12px_32px_rgba(0,27,121,0.12)] hover:border-[#0453cd]/40 transition-all duration-300 space-y-4">
                                    
                                    <!-- Year Display -->
                                    <div class="text-3xl sm:text-4xl font-extrabold text-[#001b79] group-hover:text-[#0453cd] transition-colors tracking-tight">
                                        {{ $milestone['year'] }}
                                    </div>

                                    <!-- Bullet List Items -->
                                    <ul class="space-y-3 text-sm sm:text-base text-[#454652]">
                                        @foreach ($milestone['list'] as $item)
                                            <li class="flex items-start gap-2.5 text-left">
                                                <span class="text-[#0453cd] font-black shrink-0 select-none text-base leading-relaxed">&gt;</span>
                                                <span class="flex-1 min-w-0 font-medium leading-relaxed">{{ is_array($item) ? ($item['value'] ?? implode(', ', $item)) : $item }}</span>
                                            </li>
                                        @endforeach
                                    </ul>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <x-common.empty-state title="Belum Ada Milestone" message="Data linimasa sejarah organisasi akan segera ditambahkan." />
        @endif

    </div>
</section>
