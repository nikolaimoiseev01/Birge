<section id="team" class="bg-azure-500 py-[140px] text-white">
    <div class="mx-auto container">
        <div
            class="mb-9 flex items-center justify-between transition-all duration-700 ease-out"
        >
            <h2 class="">
                Эксперты Birge
            </h2>

            <div class="flex gap-2">
                <button
                    class="team-prev gradient-border-cirle flex h-12 w-12 items-center justify-center border-gradient !rounded-full bg-azure-500/10 hover hover:bg-azure-500/20 transition">
                    <svg width="12" height="21" viewBox="0 0 12 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.0146 19.9071L1.41465 10.3071L11.0146 0.707104" stroke="white" stroke-width="2"/>
                    </svg>
                </button>
                <button
                    class="team-next gradient-border-cirle flex h-12 w-12 items-center justify-center border-gradient !rounded-full bg-azure-500/10 hover hover:bg-azure-500/20 transition">
                    <svg width="12" height="21" viewBox="0 0 12 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.707031 19.9071L10.307 10.3071L0.707031 0.707104" stroke="white" stroke-width="2"/>
                    </svg>
                </button>
            </div>
        </div>

        <div
            x-data="revealOnScroll(150)"
            :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
            class="swiper team-swiper transition-all duration-700 ease-out"
        >
            <div class="swiper-wrapper">
                @foreach($experts as $expert)
                    <article
                        class="swiper-slide cursor-pointer overflow-hidden rounded bg-[#102b34]"
                        @click="$dispatch('open-expert', { id: {{ $expert->id }} })"
                    >
                        <img
                            data-expert-image="{{ $expert->id }}"
                            src="{{ $expert->getFirstMediaUrl('image') }}"
                            alt="{{ $expert->name }}"
                            class="h-[362px] w-[328px] object-cover"
                        >

                        <div class="min-h-[150px] p-4">
                            <h3 class="text-lg font-semibold leading-tight">
                                {{ $expert->name }}
                            </h3>

                            <p class="mt-2 text-sm leading-snug text-white/55">
                                {{ $expert->description_short }}
                            </p>

                            <span class="mt-4 block text-sm text-white/75">
            Подробнее
        </span>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
    <livewire:components.expert-popup />
</section>

@push('scripts')
    <script>
        function initTeamSwiper() {
            const el = document.querySelector('.team-swiper');

            if (!el) {
                return;
            }

            if (el.swiper) {
                el.swiper.destroy(true, true);
            }

            new Swiper(el, {
                slidesPerView: 4,
                slidesPerGroup: 4,
                spaceBetween: 14,
                speed: 650,
                navigation: {
                    nextEl: '.team-next',
                    prevEl: '.team-prev',
                },
                breakpoints: {
                    0: {
                        slidesPerView: 1.15,
                        slidesPerGroup: 1,
                    },
                    640: {
                        slidesPerView: 2,
                        slidesPerGroup: 2,
                    },
                    768: {
                        slidesPerView: 3,
                        slidesPerGroup: 3,
                    },
                    1024: {
                        slidesPerView: 4,
                        slidesPerGroup: 4,
                    },
                },
            });
        }

        document.addEventListener('DOMContentLoaded', initTeamSwiper);

        document.addEventListener('livewire:navigated', () => {
            setTimeout(initTeamSwiper, 0);
        });
    </script>
@endpush
