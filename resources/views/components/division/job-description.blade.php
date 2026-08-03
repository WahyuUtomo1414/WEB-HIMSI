@props(['division'])

<section class="space-y-8">
    <x-common.section-header 
        badge="Tugas Utama"
        title="Tugas Utama & Tanggung Jawab" 
        subtitle="Daftar tugas inti dan ruang lingkup program kerja divisi" 
        align="left" />

    @if (count($division['job_description']) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ($division['job_description'] as $job)
                <div class="card-nexus rounded-2xl p-5 flex items-start gap-4">
                    <div class="h-8 w-8 rounded-full bg-[#f0f4ff] text-[#001b79] flex items-center justify-center font-bold text-sm shrink-0">
                        ✓
                    </div>
                    <p class="text-sm font-medium text-[#1a1c1e] pt-1">
                        {{ is_array($job) ? ($job['value'] ?? implode(', ', $job)) : $job }}
                    </p>
                </div>
            @endforeach
        </div>
    @else
        <x-common.empty-state title="Tugas Utama Belum Tersedia" message="Detail daftar tugas divisi ini akan segera dilengkapi." />
    @endif
</section>
