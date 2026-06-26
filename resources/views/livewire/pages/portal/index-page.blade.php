@push('styles')
    <style>
        .birge-bg {
            background: radial-gradient(circle at 75% 20%, rgba(153, 213, 184, .42), transparent 28%),
            radial-gradient(circle at 50% 0%, rgba(31, 139, 126, .5), transparent 38%),
            linear-gradient(180deg, #092f34 0%, #071d27 74%, #061722 100%);
        }

        .birge-soft-card {
            background: radial-gradient(circle at 60% 28%, rgba(30, 145, 132, .48), transparent 42%),
            linear-gradient(135deg, rgba(225, 234, 216, .96), rgba(211, 224, 204, .76));
        }

        .team-swiper .swiper-slide {
            height: auto;
        }

        .swiper-button-disabled {
            opacity: .35;
            pointer-events: none;
        }
    </style>
@endpush

<div class="text-[#071b25] relative">

    <div class="page-bg fixed inset-0 h-screen pointer-events-none z-[-2] bg-azure-500"></div>

    <div class="page-vectors fixed inset-0 h-screen pointer-events-none z-0 ">
        <img src="/fixed/welcome-vector-1.svg"
             class="absolute left-[56%] top-0 -translate-x-1/2 blur-[200px]"
             alt="">

        <img src="/fixed/welcome-vector-2.svg"
             class="absolute right-[12%] top-[45vh] blur-[200px]"
             alt="">
    </div>

    <x-index-page-blocks.welcome :first-article="$articles[0]"/>

    <div class="team-about-transition relative h-screen overflow-hidden md:h-auto md:overflow-visible">
        <div class="transition-bg absolute inset-0 z-0 0"></div>

        <div class="team-layer absolute inset-0 z-20 md:relative md:inset-auto md:z-auto">
            <x-index-page-blocks.experts :experts="$experts"/>
        </div>

        <div class="about-layer absolute inset-0 z-30 pointer-events-none md:relative md:inset-auto md:z-auto md:pointer-events-auto">
            <x-index-page-blocks.expertise :expertise="$expertise"/>
        </div>
    </div>

    <div class="analytics-telegram-transition relative h-screen overflow-visible bg-azure-500">
        <div class="telegram-bg absolute inset-0 z-0 bg-azure-500"></div>

        <div class="telegram-vectors fixed inset-0 z-10 pointer-events-none opacity-0">
            <img src="/fixed/welcome-vector-1.svg"
                 class="absolute left-[56%] top-0 -translate-x-1/2 blur-[200px]"
                 alt="">

            <img src="/fixed/welcome-vector-2.svg"
                 class="absolute right-[12%] top-[45vh] blur-[200px]"
                 alt="">
        </div>

        <div class="analytics-layer absolute inset-0 z-20">
            <x-index-page-blocks.analytics :articles="$articles"/>
        </div>

        <div class="telegram-layer absolute inset-0 z-30 pointer-events-none">
            <x-index-page-blocks.telegram :telegramPosts="$telegramPosts"/>
        </div>
    </div>

</div>

@push('scripts')
    <script type="module">
        function initTeamAboutTransition() {

            gsap.registerPlugin(ScrollTrigger);

            const wrapper = document.querySelector('.team-about-transition');
            const teamLayer = wrapper?.querySelector('.team-layer');
            const aboutLayer = wrapper?.querySelector('.about-layer');
            const about = wrapper?.querySelector('#about');
            const track = wrapper?.querySelector('.about-track');
            const container = wrapper?.querySelector('#about .container');
            const vectors = document.querySelector('.page-vectors');
            const pageBg = document.querySelector('.page-bg');
            const isMobile = window.innerWidth < 768;
            // const bg = wrapper?.querySelector('.transition-bg');

            if (!wrapper || !teamLayer || !aboutLayer || !about || !track || !container || !vectors || !pageBg) {
                return;
            }

            ScrollTrigger.getAll().forEach(trigger => {
                if (trigger.vars?.id?.startsWith('team-about-transition')) {
                    trigger.kill();
                }
            });

            gsap.killTweensOf([wrapper, teamLayer, aboutLayer, about, track, vectors]);

            const getScrollDistance = () => {
                const containerWidth = container.getBoundingClientRect().width;

                return Math.max(0, track.scrollWidth - containerWidth);
            };

            // gsap.set(wrapper, {
            //     backgroundColor: '#0F3F46',
            // });
            gsap.set(vectors, {
                opacity: 1,
                y: 0,
            });

            gsap.set(teamLayer, {
                y: 0,
                opacity: 1,
            });

            gsap.set(aboutLayer, {
                opacity: 0,
                y: 80,
                pointerEvents: 'none',
            });

            gsap.set(track, {
                x: 0,
            });

            const tl = gsap.timeline({
                scrollTrigger: {
                    id: 'team-about-transition-main',
                    trigger: wrapper,
                    start: 'top top',
                    end: () => isMobile
                        ? `+=${window.innerHeight * 0.5}`
                        : `+=${window.innerHeight * 0.7 + getScrollDistance()}`,
                    scrub: 1,
                    pin: !isMobile,
                    pinSpacing: !isMobile,
                    anticipatePin: isMobile ? 0 : 1,
                    invalidateOnRefresh: true,
                }
            });

            tl.to(teamLayer, {
                y: -160,
                opacity: 0,
                ease: 'none',
                duration: 0.2,
            }, 0);

            tl.to(vectors, {
                y: -120,
                opacity: 0,
                ease: 'none',
                duration: 0.2,
            }, '<');

            tl.to(pageBg, {
                backgroundColor: '#EFF5E9',
                ease: 'none',
                duration: 0.2,
            }, '<');

            tl.to({}, {
                duration: 0.15,
            });

            tl.to(aboutLayer, {
                opacity: 1,
                y: 0,
                ease: 'none',
                duration: 0.22,
                onStart() {
                    aboutLayer.style.pointerEvents = 'auto';
                },
                onReverseComplete() {
                    aboutLayer.style.pointerEvents = 'none';
                },
            });

            if (!isMobile) {
                tl.to(track, {
                    x: () => -getScrollDistance(),
                    ease: 'none',
                    duration: 1,
                });
            }

            ScrollTrigger.refresh();
        }

        function initAnalyticsTelegramTransition() {

            gsap.registerPlugin(ScrollTrigger);

            const wrapper = document.querySelector('.analytics-telegram-transition');
            const bg = wrapper?.querySelector('.telegram-bg');
            const vectors = wrapper?.querySelector('.telegram-vectors');
            const analyticsLayer = wrapper?.querySelector('.analytics-layer');
            const telegramLayer = wrapper?.querySelector('.telegram-layer');

            const isMobile = window.innerWidth < 768;

            // const isMobile = false;

            if (!wrapper || !analyticsLayer || !telegramLayer) {
                return;
            }

            ScrollTrigger.getAll().forEach(trigger => {
                if (trigger.vars?.id?.startsWith('analytics-telegram-transition')) {
                    trigger.kill();
                }
            });

            gsap.killTweensOf([wrapper, bg, vectors, analyticsLayer, telegramLayer]);

            if (bg) {
                gsap.set(bg, {
                    backgroundColor: '#EFF5E9',
                });
            }

            if (vectors) {
                gsap.set(vectors, {
                    opacity: 0,
                    y: 120,
                });
            }
            analyticsLayer.style.pointerEvents = 'auto';
            gsap.set(analyticsLayer, {
                y: 0,
                opacity: 1,
            });

            gsap.set(telegramLayer, {
                opacity: 0,
                y: 80,
                pointerEvents: 'none',
            });

            const tl = gsap.timeline({
                scrollTrigger: {
                    id: 'analytics-telegram-transition-main',
                    trigger: wrapper,
                    start: 'top top',
                    end: () => isMobile
                        ? `+=${window.innerHeight * 1.4}`
                        : `+=${window.innerHeight * 0.9}`,
                    scrub: 1,
                    pin: true,
                    pinSpacing: true,
                    anticipatePin: true,
                    invalidateOnRefresh: true,
                }
            });

            // 1. Аналитика исчезает
            tl.to(analyticsLayer, {
                y: -160,
                opacity: 0,
                ease: 'none',
                duration: 0.25,

                onStart() {
                    window.dispatchEvent(new CustomEvent('hide-articles-preview'));
                    analyticsLayer.style.pointerEvents = 'none';
                },

                onReverseComplete() {
                    analyticsLayer.style.pointerEvents = 'auto';
                },
            }, 0);

            tl.to({}, {
                duration: 0.8,   // чем больше число, тем дольше он будет закреплен
            });

            // 2. Фон темнеет и вектора появляются одновременно
            if (bg) {
                tl.to(bg, {
                    backgroundColor: '#0A1C2B',
                    ease: 'none',
                    duration: 0.25,
                }, '<');
            }

            if (vectors) {
                tl.to(vectors, {
                    y: 0,
                    opacity: 1,
                    ease: 'none',
                    duration: 0.25,
                }, '<');
            }

            // 3. Пауза
            tl.to({}, {
                duration: 0.15,
            });

            // 4. Telegram появляется
            tl.to(telegramLayer, {
                opacity: 1,
                y: 0,
                ease: 'none',
                duration: 0.25,
                onStart() {
                    telegramLayer.style.pointerEvents = 'auto';
                },
                onReverseComplete() {
                    telegramLayer.style.pointerEvents = 'none';
                },
            });

            // удерживаем Telegram на экране
            tl.to({}, {
                duration: 0.8,   // чем больше число, тем дольше он будет закреплен
            });

            ScrollTrigger.refresh();
        }

        function initPageTransitions() {
            initTeamAboutTransition();
            initAnalyticsTelegramTransition();
        }

        document.addEventListener('DOMContentLoaded', initPageTransitions);

        document.addEventListener('livewire:navigated', () => {
            setTimeout(initPageTransitions, 0);
        });
    </script>
@endpush
