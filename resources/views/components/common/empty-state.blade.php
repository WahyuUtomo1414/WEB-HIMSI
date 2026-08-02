@props([
    'title' => 'Data Belum Tersedia',
    'message' => 'Saat ini belum ada informasi yang dapat ditampilkan pada bagian ini.'
])

<div class="rounded-2xl border border-dashed border-[#c5c5d4] bg-[#f0f4ff]/50 p-10 text-center my-6">
    <div class="mx-auto h-12 w-12 rounded-full bg-[#f0f4ff] flex items-center justify-center text-[#0453cd] mb-3">
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
    </div>
    <h3 class="text-lg font-bold text-[#000c46]">{{ $title }}</h3>
    <p class="mt-1 text-sm text-[#454652] max-w-md mx-auto">{{ $message }}</p>
</div>
