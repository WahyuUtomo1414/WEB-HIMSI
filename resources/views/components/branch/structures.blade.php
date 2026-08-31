@props(['branch', 'structures'])

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

        @php
            $item1 = $structures[0] ?? null;
            $item2 = $structures[1] ?? null;
            $row3  = array_slice($structures, 2, 3);
            $row4  = array_slice($structures, 5, 4);
            $row5  = array_slice($structures, 9, 4);
            $remaining = array_slice($structures, 13);
        @endphp

        @if (count($structures) > 0)
            <div class="space-y-12 max-w-6xl mx-auto">

                {{-- Row 1: Item 1 (Top Leader Centered) --}}
                @if ($item1)
                    <div class="flex flex-col items-center">
                        <div class="w-full sm:w-[300px] md:w-[320px]">
                            <x-branch._structure_card :person="$item1" />
                        </div>
                    </div>
                @endif

                {{-- Row 2: Item 2 (Deputy/Secretary Centered) --}}
                @if ($item2)
                    <div class="flex flex-col items-center relative">
                        <div class="w-0.5 h-8 bg-[#001b79]/20 -mt-8 mb-4"></div>
                        <div class="w-full sm:w-[300px] md:w-[320px]">
                            <x-branch._structure_card :person="$item2" />
                        </div>
                    </div>
                @endif

                {{-- Row 3: Items 3, 4, 5 (3 Columns) --}}
                @if (count($row3) > 0)
                    <div class="flex flex-col items-center relative">
                        <div class="w-0.5 h-8 bg-[#001b79]/20 -mt-8 mb-4"></div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 max-w-4xl w-full">
                            @foreach ($row3 as $person)
                                <div>
                                    <x-branch._structure_card :person="$person" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Row 4: Items 6, 7, 8, 9 (4 Columns) --}}
                @if (count($row4) > 0)
                    <div class="flex flex-col items-center relative">
                        <div class="w-0.5 h-8 bg-[#001b79]/20 -mt-8 mb-4"></div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 w-full">
                            @foreach ($row4 as $person)
                                <div>
                                    <x-branch._structure_card :person="$person" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Row 5: Items 10, 11, 12, 13 (4 Columns) --}}
                @if (count($row5) > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 w-full pt-2">
                        @foreach ($row5 as $person)
                            <div>
                                <x-branch._structure_card :person="$person" />
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Remaining Items (> 13) --}}
                @if (count($remaining) > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 w-full pt-2">
                        @foreach ($remaining as $person)
                            <div>
                                <x-branch._structure_card :person="$person" />
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        @else
            <x-common.empty-state title="Belum Ada Pengurus" message="Data struktur pengurus untuk cabang ini belum ditambahkan." />
        @endif

    </div>
</section>
