@props(['organization'])

<section class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-[#001b79]/5 via-[#0453cd]/5 to-[#eef4ff] p-8 md:p-12 border border-[#356ee7]/20 shadow-[0_4px_20px_rgba(0,27,121,0.03)] space-y-4">
    <div class="flex flex-col sm:flex-row sm:items-center gap-4">
        <div class="h-12 w-12 rounded-2xl bg-[#001b79] text-white flex items-center justify-center shrink-0 shadow-md">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
        </div>
        <x-common.section-header 
            badge="Tujuan"
            title="Tujuan Pembentukan HIMSI" 
            align="left" />
    </div>
    <div class="prose max-w-4xl text-base sm:text-lg text-[#454652] leading-relaxed pt-2 prose-p:mb-4 last:prose-p:mb-0">
        {!! $organization['purpose'] !!}
    </div>
</section>
