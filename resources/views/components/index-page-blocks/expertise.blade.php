<section id="about" class="h-screen md:h-auto services-section overflow-hidden bg-mint-200 py-16 sm:px-4 relative z-40">
    <style>
        .gradient-border-cirle {
            border-radius: 9999px;
        }

        .gradient-border-cirle::before {
            content: "";
            position: absolute;
            inset: 0;
            padding: 1px;
            border-radius: inherit;

            background: linear-gradient(
                135deg,
                rgba(41, 90, 87, 1) 0%,
                rgba(41, 90, 87, 0) 100%
            );

            -webkit-mask:
                linear-gradient(#fff 0 0) content-box,
                linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;

            mask:
                linear-gradient(#fff 0 0) content-box,
                linear-gradient(#fff 0 0);
            mask-composite: exclude;

            pointer-events: none;
        }
    </style>
    <div class="mx-auto container md:w-full">
        <h2
            x-data="revealOnScroll()"
            :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
            class="text-azure-500 transition-all duration-700 ease-out mb-10"
        >
            Области нашей экспертизы
        </h2>

        <div
            x-data="revealOnScroll(150)"
            :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
            class="services-viewport overflow-visible transition-all duration-700 ease-out"
        >
            <div class="services-track flex md:flex-col gap-4 will-change-transform">
                @foreach($expertise as $key => $item)
                    <article
                        class="@if($loop->even) mt-10 md:mt-0 @endif p-6 birge-soft-card relative flex h-[520px] w-[520px] md:w-full md:min-w-0 md:min-h-[328px] md:h-auto min-w-[520px] flex-col justify-end rounded-lg bg-[#D3DCCB] group hover:bg-mint-800"
                    >
                        <img src="/fixed/expertise/expertise-{{$key + 1}}.1.svg" class="absolute {{$item['bg-class']}} transition group-hover:opacity-0" alt="">
                        <img src="/fixed/expertise/expertise-{{$key + 1}}.2.svg" class="absolute {{$item['bg-class']}} transition group-hover:opacity-0" alt="">

                        <img src="/fixed/expertise/expertise-{{$key + 1}}.1_hover.svg" class="absolute {{$item['bg-class']}} opacity-0 transition group-hover:opacity-100" alt="">
                        <img src="/fixed/expertise/expertise-{{$key + 1}}.2_hover.svg" class="absolute {{$item['bg-class']}} opacity-0 transition group-hover:opacity-100" alt="">
                        <button
                            class="gradient-border-cirle absolute right-4 top-4 flex h-12 w-12 items-center justify-center rounded-full bg-mint-800/10">
                            <img src="/fixed/plus.svg" alt="" class="transition group-hover:hidden">
                            <svg class="transition hidden group-hover:block" width="24" height="2" viewBox="0 0 24 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect y="2" width="2" height="24" transform="rotate(-90 0 2)" fill="white"/>
                            </svg>

                        </button>

                        <h3 class="max-w-sm text-4xl min-w-full font-medium text-[#295A57] md:text-xl relative z-20 group-hover:hidden transition">
                            {!! $item['title'] !!}
                        </h3>
                        <div class="flex-col relative z-40 text-white text-lg hidden group-hover:flex transition md:pt-16">
                            <ul class='list-disc space-y-1 pl-4 leading-[1.5rem] mb-6 md:text-sm'>
                                {!! $item['description'] !!}
                            </ul>
                            <a href="" class="w-full py-4 rounded-[26px] md:leading-3 bg-white font-medium text-center leading-none text-azure-600 md:text-sm">Запросить консультацию</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</section>

@push('scripts')
    <script type="module">
        document.addEventListener('DOMContentLoaded', () => {
            gsap.registerPlugin(ScrollTrigger);

            const section = document.querySelector('#services');
            const track = section.querySelector('.services-track');

            const container = section.querySelector('.container');

            const getScrollDistance = () => {
                const containerRect = container.getBoundingClientRect();

                return track.scrollWidth - containerRect.width;
            };

            gsap.to(track, {
                x: () => -getScrollDistance(),
                ease: 'none',
                scrollTrigger: {
                    trigger: section,
                    start: 'top top',
                    end: () => `+=${getScrollDistance()}`,
                    scrub: true,
                    pin: true,
                    anticipatePin: 1,
                    invalidateOnRefresh: true,
                }
            });
        });
    </script>
@endpush
