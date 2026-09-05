@props(['branch', 'ketua', 'wakilKetua', 'sekben', 'koorChunks'])

<section x-data="{
             initCanvas() {
                 const canvas = this.$refs.splashCanvas;
                 if (!canvas) return;
                 const ctx = canvas.getContext('2d');
                 let width = canvas.width = this.$el.offsetWidth;
                 let height = canvas.height = this.$el.offsetHeight;
                 
                 const resizeObserver = new ResizeObserver(() => {
                     width = canvas.width = this.$el.offsetWidth;
                     height = canvas.height = this.$el.offsetHeight;
                 });
                 resizeObserver.observe(this.$el);

                 let particles = [];
                 let ripples = [];

                 this.$el.addEventListener('mousemove', (e) => {
                     const rect = this.$el.getBoundingClientRect();
                     const x = e.clientX - rect.left;
                     const y = e.clientY - rect.top;
                     
                     for (let i = 0; i < 2; i++) {
                         particles.push({
                             x: x + (Math.random() - 0.5) * 14,
                             y: y + (Math.random() - 0.5) * 14,
                             radius: Math.random() * 8 + 6,
                             alpha: 0.35,
                             vx: (Math.random() - 0.5) * 1.2,
                             vy: (Math.random() - 0.5) * 1.2 - 0.3
                         });
                     }
                 });

                 this.$el.addEventListener('click', (e) => {
                     const rect = this.$el.getBoundingClientRect();
                     const x = e.clientX - rect.left;
                     const y = e.clientY - rect.top;

                     ripples.push({
                         x, y, radius: 12, maxRadius: 80, alpha: 0.6
                     });
                 });

                 function animate() {
                     ctx.clearRect(0, 0, width, height);

                     // Draw & Update Particles
                     for (let i = particles.length - 1; i >= 0; i--) {
                         const p = particles[i];
                         p.x += p.vx;
                         p.y += p.vy;
                         p.alpha -= 0.012;
                         p.radius += 0.35;

                         if (p.alpha <= 0) {
                             particles.splice(i, 1);
                             continue;
                         }

                         ctx.beginPath();
                         ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
                         ctx.fillStyle = `rgba(53, 110, 231, ${p.alpha})`;
                         ctx.fill();
                     }

                     // Draw & Update Ripples
                     for (let i = ripples.length - 1; i >= 0; i--) {
                         const r = ripples[i];
                         r.radius += (r.maxRadius - r.radius) * 0.08;
                         r.alpha -= 0.015;

                         if (r.alpha <= 0 || r.radius >= r.maxRadius - 1) {
                             ripples.splice(i, 1);
                             continue;
                         }

                         ctx.beginPath();
                         ctx.arc(r.x, r.y, r.radius, 0, Math.PI * 2);
                         ctx.strokeStyle = `rgba(4, 83, 205, ${r.alpha})`;
                         ctx.lineWidth = 2.5;
                         ctx.stroke();

                         ctx.beginPath();
                         ctx.arc(r.x, r.y, r.radius * 0.7, 0, Math.PI * 2);
                         ctx.fillStyle = `rgba(53, 110, 231, ${r.alpha * 0.25})`;
                         ctx.fill();
                     }

                     requestAnimationFrame(animate);
                 }

                 animate();
             }
         }"
         x-init="initCanvas()"
         class="w-full bg-[#eef4ff] py-16 sm:py-20 lg:py-28 border-y border-[#c5c5d4]/40 relative overflow-hidden isolate">

    <!-- Hardware-Accelerated 60FPS HTML5 Canvas Overlay -->
    <canvas x-ref="splashCanvas" class="absolute inset-0 pointer-events-none z-0 w-full h-full"></canvas>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-12">

        <x-common.section-header 
            badge="Pengurus"
            title="Struktur Kepengurusan Cabang" 
            :subtitle="'Daftar pengurus aktif yang memimpin jalannya organisasi di ' . $branch['name']" />

        @if ($ketua || $wakilKetua || count($sekben) > 0 || count($koorChunks) > 0)
            <div class="space-y-12 max-w-6xl mx-auto">

                {{-- Row 1: Ketua (centered) --}}
                @if ($ketua)
                    <div class="flex flex-col items-center">
                        <div class="w-full sm:w-[300px] md:w-[320px]">
                            <x-branch._structure_card :person="$ketua" />
                        </div>
                    </div>
                @endif

                {{-- Row 2: Wakil Ketua (centered) --}}
                @if ($wakilKetua)
                    <div class="flex flex-col items-center relative">
                        <div class="w-0.5 h-8 bg-[#001b79]/20 -mt-8 mb-4"></div>
                        <div class="w-full sm:w-[300px] md:w-[320px]">
                            <x-branch._structure_card :person="$wakilKetua" />
                        </div>
                    </div>
                @endif

                {{-- Row 3: Sekretaris & Bendahara (1 baris, kolom menyesuaikan jumlah) --}}
                @if (count($sekben) > 0)
                    <div class="flex flex-col items-center relative">
                        <div class="w-0.5 h-8 bg-[#001b79]/20 -mt-8 mb-4"></div>
                        @if (count($sekben) === 1)
                            <div class="w-full sm:w-[300px] md:w-[320px]">
                                <x-branch._structure_card :person="$sekben[0]" />
                            </div>
                        @elseif (count($sekben) === 2)
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 max-w-xl w-full">
                                @foreach ($sekben as $person)
                                    <x-branch._structure_card :person="$person" />
                                @endforeach
                            </div>
                        @elseif (count($sekben) === 3)
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 max-w-3xl w-full">
                                @foreach ($sekben as $person)
                                    <x-branch._structure_card :person="$person" />
                                @endforeach
                            </div>
                        @else
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 w-full">
                                @foreach ($sekben as $person)
                                    <x-branch._structure_card :person="$person" />
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif

                {{-- Row 4+: Koordinator (selalu paling bawah, 4 per baris) --}}
                @foreach ($koorChunks as $chunkIndex => $chunk)
                    <div class="flex flex-col items-center relative">
                        @if ($chunkIndex === 0)
                            <div class="w-0.5 h-8 bg-[#001b79]/20 -mt-8 mb-4"></div>
                        @endif
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 w-full">
                            @foreach ($chunk as $person)
                                <x-branch._structure_card :person="$person" />
                            @endforeach
                        </div>
                    </div>
                @endforeach

            </div>
        @else
            <x-common.empty-state title="Belum Ada Pengurus" message="Data struktur pengurus untuk cabang ini belum ditambahkan." />
        @endif

    </div>
</section>
