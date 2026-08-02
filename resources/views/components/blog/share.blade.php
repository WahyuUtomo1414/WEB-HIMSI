@props(['blog'])

<div class="rounded-3xl p-6 sm:p-8 bg-white border border-[#c5c5d4]/60 shadow-[0_4px_20px_rgba(0,27,121,0.04)] space-y-5">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="space-y-1">
            <h4 class="text-lg font-bold text-[#000c46]">Media Sosial Resmi Organisasi</h4>
            <p class="text-xs text-[#454652]">Ikuti kanal resmi HIMSI UBSI untuk kabar kegiatan dan informasi terkini</p>
        </div>
        <div class="flex items-center gap-2 flex-wrap">
            <a href="https://instagram.com/himsi.ubsi" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-xl bg-[#001b79]/5 hover:bg-[#001b79] text-[#0453cd] hover:text-white border border-[#001b79]/15 px-4 py-2 text-xs font-bold transition-all shadow-xs group">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                </svg>
                <span>Instagram</span>
            </a>
            <a href="https://youtube.com/@himsiubsi" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-xl bg-red-50 hover:bg-red-600 text-red-600 hover:text-white border border-red-200 px-4 py-2 text-xs font-bold transition-all shadow-xs group">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path>
                    <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon>
                </svg>
                <span>YouTube</span>
            </a>
            <a href="mailto:dpp.himsi@gmail.com" class="inline-flex items-center gap-2 rounded-xl bg-slate-100 hover:bg-[#000c46] text-[#000c46] hover:text-white border border-slate-200 px-4 py-2 text-xs font-bold transition-all shadow-xs group">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <span>Email</span>
            </a>
        </div>
    </div>
</div>
