@props(['counts'])

@if (count($counts) > 0)
    <section class="py-2 sm:py-3">
        <div class="rounded-3xl bg-white p-8 md:p-12 border border-[#c5c5d4]/60 shadow-[0_4px_20px_rgba(0,27,121,0.05)]">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-x-0 md:divide-x divide-slate-100">
                @foreach ($counts as $count)
                    <div class="space-y-2 p-2"
                         x-data="{
                            current: 0,
                            target: 0,
                            suffix: '',
                            hasAnimated: false,
                            init() {
                                const raw = @js($count['digit']);
                                const match = String(raw).match(/^(\d+)(.*)$/);
                                if (match) {
                                    this.target = parseInt(match[1], 10);
                                    this.suffix = match[2] || '';
                                } else {
                                    this.target = 0;
                                    this.suffix = String(raw);
                                }

                                const observer = new IntersectionObserver((entries) => {
                                    if (entries[0].isIntersecting && !this.hasAnimated) {
                                        this.hasAnimated = true;
                                        this.animate();
                                    }
                                }, { threshold: 0.2 });
                                observer.observe(this.$el);
                            },
                            animate() {
                                const duration = 1800;
                                const startTime = performance.now();
                                const startVal = 0;
                                const endVal = this.target;

                                const updateCount = (currentTime) => {
                                    const elapsed = currentTime - startTime;
                                    const progress = Math.min(elapsed / duration, 1);
                                    const easeProgress = 1 - Math.pow(1 - progress, 3);
                                    this.current = Math.floor(easeProgress * (endVal - startVal) + startVal);

                                    if (progress < 1) {
                                        requestAnimationFrame(updateCount);
                                    } else {
                                        this.current = endVal;
                                    }
                                };

                                requestAnimationFrame(updateCount);
                            }
                         }">
                        <div class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#001b79] tracking-tight">
                            <span x-text="current + suffix">{{ $count['digit'] }}</span>
                        </div>
                        <div class="text-xs sm:text-sm font-semibold uppercase tracking-wider text-[#454652]">
                            {{ $count['name'] }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
