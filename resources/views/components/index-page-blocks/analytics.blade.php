<section id="articles" class="bg-mint-200 pb-20 relative z-40">
    <div class="mx-auto container">
        <h2
            x-data="revealOnScroll()"
            :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
            class="mb-11 text-azure-500 transition-all duration-700 ease-out"
        >
            Исследования и аналитика
        </h2>

        <div
            x-data="articlesPreview()"
            @mouseenter="inside = true"
            @mouseleave="leave()"
            @mousemove="move($event)"
            class=" mb-10"
        >
            {{-- Preview --}}
            <div
                x-show="visible"
                :style="`left:${x}px; top:${y}px; opacity:${active ? 1 : 0}`"
                class="pointer-events-none fixed z-[9999]
           h-[174px] w-[300px]
           -translate-x-1/2 -translate-y-1/2
           overflow-hidden rounded-lg bg-white shadow-2xl
           transition-opacity duration-500 ease-out"
            >
                <div
                    class="h-full transition-transform duration-1000 ease-[cubic-bezier(.16,1,.3,1)] will-change-transform"
                    :style="`transform: translate3d(0, -${activeIndex * 174}px, 0)`"
                >
                    @foreach($articles as $article)
                        <div class="h-[174px] w-[300px] overflow-hidden">
                            <img
                                src="{{ $article->getFirstMediaUrl('cover') }}"
                                class="h-full w-full object-cover"
                                draggable="false"
                                alt=""
                            >
                        </div>
                    @endforeach
                </div>

                <div class="absolute inset-0 flex items-center justify-center">
                <span class="rounded-full bg-white/90 px-6 py-3 text-sm font-medium text-black backdrop-blur">
                    Читать
                </span>
                </div>
            </div>

            @foreach($articles as $i => $article)
                <a
                    href="{{ route('portal.article', $article->slug) }}"
                    wire:navigate
                    x-data="revealOnScroll({{ $i * 70 }})"
                    @mouseenter="show({{ $i }})"
                    :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
                    class="relative grid grid-cols-[150px_1fr_1.15fr] gap-10 border-y border-[#082329]/15 !border-t-0 last:!border-b-0 py-5
                   transition-all duration-700 ease-out first:border-t-0 hover:bg-white/35
                   lg:grid-cols-[110px_1fr] lg:gap-6 md:grid-cols-1 md:flex-col md:flex md:!gap-4"
                >
                    <time class="text-lg text-[#1E1E1E]/50 md:text-[13px]">
                        {{ $article['date'] }}
                    </time>

                    <h3 class="line-clamp-2 text-2xl font-medium md:text-[17px] leading-tight tracking-[-0.03em] text-azure-600">
                        {{ $article['title'] }}
                    </h3>

                    <p class="line-clamp-3 text-lg leading-relaxed  md:text-sm text-azure-600 lg:col-start-2 md:col-start-auto">
                        {{ $article['description'] }}
                    </p>
                </a>
            @endforeach
        </div>

        <x-Ui.link href="{{route('portal.article_list')}}" class="md:w-full md:py-[13px]" type="teal">Смотреть все статьи</x-Ui.link>
    </div>
</section>

@push('scripts')
    <script>
        function articlesPreview() {
            return {
                visible: false,
                active: false,
                inside: false,

                activeIndex: 0,

                x: 0,
                y: 0,

                targetX: 0,
                targetY: 0,

                raf: null,
                hideTimeout: null,

                show(index) {
                    clearTimeout(this.hideTimeout)

                    this.activeIndex = index
                    this.visible = true
                    this.active = true
                },

                leave() {
                    this.inside = false
                    this.active = false

                    clearTimeout(this.hideTimeout)

                    this.hideTimeout = setTimeout(() => {
                        this.visible = false
                    }, 500)
                },

                move(e) {
                    this.inside = true

                    this.targetX = e.clientX
                    this.targetY = e.clientY

                    if (!this.visible) {
                        this.visible = true
                    }

                    if (!this.active) {
                        this.active = true
                    }

                    if (!this.raf) {
                        this.animate()
                    }
                },

                animate() {
                    this.x += (this.targetX - this.x) * 0.1
                    this.y += (this.targetY - this.y) * 0.1

                    this.raf = requestAnimationFrame(() => this.animate())
                },
            }
        }
    </script>
    @endpush
