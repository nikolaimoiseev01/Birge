<section class="flex items-center min-h-screen text-white md:pb-14 sm:px-4">
    <div
        class="mx-auto grid container grid-cols-[1.35fr_.65fr] gap-16 transition-all lg:grid-cols-1 lg:gap-10 md:mt-10">
        <div
            x-data="revealOnScroll(100)"
            :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
            class="transition-all duration-900 ease-out z-20 mx-auto"
        >
            <h1 class="text-white min-w-max leading-[60px] xl:!min-w-0 mb-16">
                Команда профессионалов в области<br>
                организационного дизайна,<br>
                вознаграждения и формирования<br>
                управленческих команд<br>
            </h1>

            <div class="grid max-w-4xl grid-cols-[max-content_max-content] gap-x-14 gap-y-7 md:grid-cols-1 mb-16">
                @foreach([
                    ['title' => '15+ экспертов', 'text' => 'Команда Birge в Алматы и Москве'],
                    ['title' => 'География проектов', 'text' => 'Россия, Казахстан, Узбекистан'],
                    ['title' => 'Международный опыт', 'text' => 'Korn Ferry Hay Group и Spencer Stuart'],
                    ['title' => 'Глобальная сеть партнёров', 'text' => 'Доступ к практической экспертизе'],
                ] as $item)
                    <div class="flex gap-3">
                        <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M17.9144 10.1815C13.1164 10.3978 9.40165 14.5067 9.61999 19.356L7.87525 19.4346L7.50353 11.1782C7.49122 10.9048 7.26143 10.6926 6.99094 10.7048L0.0796564 11.0164L0.000271887 9.25302C4.79826 9.03671 8.513 4.92789 8.29468 0.0786539L10.0394 -2.97608e-06L10.4111 8.25635C10.4234 8.52973 10.6532 8.74195 10.9237 8.72975L17.835 8.41817L17.9144 10.1815Z"
                                fill="#DEFEC0"/>
                        </svg>
                        <div>
                            <p class="text-xl font-semibold leading-tight text-mint-500">
                                {{ $item['title'] }}
                            </p>
                            <p class="mt-1 leading-relaxed text-white">
                                {{ $item['text'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <x-Ui.link type="mint" class="px-8 py-4">Запросить консультацию</x-Ui.link>

        </div>

        <article
            x-data="{ shown: false }"
            x-cloak
            x-init="setTimeout(() => shown = true, 2000)"
            :class="shown ? 'translate-x-0 opacity-100' : 'translate-x-16 opacity-0'"
            class="z-20 relative -bottom-14 self-end max-w-[350px] min-w-[350px]
           flex flex-col gap-4 rounded-lg border border-white bg-mint-500/10
           p-4 backdrop-blur transition-all duration-1000 ease-out
           lg:max-w-md"
        >
            <div class="aspect-[16/10] overflow-hidden bg-white/10 rounded-lg">
                <img
                    src="{{ $firstArticle->getFirstMediaUrl('cover') }}"
                    alt=""
                    class="h-full w-full object-cover"
                >
            </div>

            <h2 class="text-[22px] font-semibold leading-tight line-clamp-4">
                {{ $firstArticle->title }}
            </h2>

            <p class="leading-relaxed text-white line-clamp-4">
                {{ $firstArticle->description }}
            </p>
        </article>
    </div>
</section>
