@props(['faqs'])

@if (count($faqs) > 0)
    <section class="space-y-10">
        <x-common.section-header 
            badge="Tanya Jawab"
            title="Pertanyaan Sering Diajukan (FAQ)" 
            subtitle="Jawaban atas pertanyaan umum seputar kegiatan dan keorganisasian HIMSI UBSI" />

        <div class="max-w-3xl mx-auto space-y-4">
            @foreach ($faqs as $index => $faq)
                <details class="card-nexus rounded-2xl p-5 group [&_summary::-webkit-details-marker]:hidden">
                    <summary class="flex cursor-pointer items-center justify-between gap-1.5 text-[#000c46] font-bold text-base">
                        <span>{{ $faq['question'] }}</span>
                        <span class="shrink-0 rounded-full bg-[#f0f4ff] p-1 text-[#0453cd] group-open:-rotate-180 transition">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </span>
                    </summary>
                    <p class="mt-3 text-sm leading-relaxed text-[#454652] pt-2 border-t border-slate-100">
                        {{ $faq['answer'] }}
                    </p>
                </details>
            @endforeach
        </div>
    </section>
@endif
