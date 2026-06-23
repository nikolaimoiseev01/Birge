@php
    $menu = [
        [
            'key' => 'about',
            'title' => 'О компании',
            'href' => route('portal.index') . '#about',
            'anchor' => true,
        ],
        [
            'key' => 'team',
            'title' => 'Команда',
            'href' => route('portal.index') . '#team',
            'anchor' => true,
        ],
        [
            'key' => 'services',
            'title' => 'Услуги',
            'href' => route('portal.index') . '#articles',
            'anchor' => true,
        ],
        [
            'key' => 'articles',
            'title' => 'Статьи',
            'href' => route('portal.article_list'),
            'navigate' => true,
        ],
        [
            'key' => 'platform',
            'title' => 'Платформа Бирге',
            'href' => route('portal.index') . '#platform',
            'anchor' => true,
        ],
    ];
@endphp

<header
    x-data="{
        menuOpen: false,
        isHome: @js(request()->routeIs('portal.index') || request()->routeIs('portal.article_list')),
        ...( @js(request()->routeIs('portal.index'))
            ? revealOnScroll()
            : { shown: true }
        )
    }"
    @keydown.escape.window="menuOpen = false"
    :class="[
        shown ? 'translate-y-0 opacity-100' : 'translate-y-6 opacity-0',
        isHome ? 'absolute bg-transparent' : 'relative bg-mint-200'
    ]"
    class="z-50 mx-auto flex w-full py-5 transition-[opacity,transform] duration-700 ease-out"
>
    <div class="flex justify-between container">
        <x-logo/>

        <div class="flex gap-10">
            {{-- Desktop nav --}}
            <nav
                :class="isHome ? 'text-white' : 'text-azure-500'"
                x-data="{ hovered: null }"
                class="flex items-center  gap-10 lg:hidden"
            >
                @foreach($menu as $item)
                    <a
                        href="{{ $item['href'] }}"
                        @if(!empty($item['anchor'])) data-anchor-link @endif
                        @mouseenter="hovered = '{{ $item['key'] }}'"
                        @mouseleave="hovered = null"
                        :class="hovered && hovered !== '{{ $item['key'] }}' ? 'opacity-40' : 'opacity-100'"
                        @if(!empty($item['navigate'])) wire:navigate @endif
                        class="{{ !empty($item['navigate']) ? 'js-page-transition' : '' }} transition-opacity duration-500"
                    >
                        {{ $item['title'] }}
                    </a>
                @endforeach
            </nav>

            <div class="flex items-center gap-8 lg:gap-5">
                <x-Ui.link class="lg:hidden" type="teal">
                    Связаться с нами
                </x-Ui.link>

                {{-- Lang --}}
                <div
                    x-data="{
        open: false,
        lang: 'Ru',
        langs: ['Ru', 'Kz', 'En'],

        otherLangs() {
            return this.langs.filter(item => item !== this.lang)
        }
    }"
                    class="relative"
                >
                    <button
                        type="button"
                        @click="open = !open"
                        :class="isHome ? 'text-white' : 'text-azure-500'"
                        class="flex items-center gap-1 text-base transition"
                    >
                        <span x-text="lang"></span>

                        <svg
                            :class="open ? 'rotate-180' : 'rotate-0'"
                            class="h-3 w-3 transition-transform duration-200 ease-out"
                            viewBox="0 0 12 12"
                            fill="none"
                        >
                            <path
                                d="M3 4.5L6 7.5L9 4.5"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </button>

                    <div
                        x-cloak
                        x-show="open"
                        @click.outside="open = false"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                        class="absolute right-0 top-full z-50 mt-3 flex w-[51px] flex-col gap-4 rounded-[8px] border border-white/60 bg-[#e2f1f0]/10 p-4 text-white shadow-[0_8px_30px_rgba(0,0,0,.25)] backdrop-blur-md"
                    >
                        <template x-for="item in otherLangs()" :key="item">
                            <button
                                type="button"
                                @click="lang = item; open = false"
                                class="text-left text-base font-medium transition hover:text-[#8dd5c2]"
                                x-text="item"
                            ></button>
                        </template>
                    </div>
                </div>

                {{-- Burger --}}
                <button
                    type="button"
                    @click="menuOpen = true"
                    :class="isHome ? 'text-white' : 'text-azure-500'"
                    class="hidden h-10 w-10 flex-col items-center justify-center gap-1.5 lg:flex"
                    aria-label="Открыть меню"
                >
                    <span class="block h-[2px] w-7 rounded-full bg-current"></span>
                    <span class="block h-[2px] w-7 rounded-full bg-current"></span>
                    <span class="block h-[2px] w-7 rounded-full bg-current"></span>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div
        x-cloak
        x-show="menuOpen"
        class="fixed inset-0 z-[999] hidden lg:block"
    >
        <div
            x-show="menuOpen"
            x-transition.opacity.duration.300ms
            class="absolute inset-0 bg-black/30"
            @click="menuOpen = false"
        ></div>

        <div
            x-show="menuOpen"
            x-transition:enter="transition-transform duration-500 ease-[cubic-bezier(.16,1,.3,1)]"
            x-transition:enter-start="translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition-transform duration-400 ease-[cubic-bezier(.7,0,.84,0)]"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            class="absolute right-0 top-0 flex h-screen w-full flex-col bg-mint-200 px-4 pb-5 pt-12 text-azure-500 shadow-2xl"
        >
            <button
                type="button"
                @click="menuOpen = false"
                class="absolute right-4 top-12 h-8 w-8"
                aria-label="Закрыть меню"
            >
                <span class="absolute left-1/2 top-1/2 block h-[2px] w-8 -translate-x-1/2 -translate-y-1/2 rotate-45 bg-azure-500"></span>
                <span class="absolute left-1/2 top-1/2 block h-[2px] w-8 -translate-x-1/2 -translate-y-1/2 -rotate-45 bg-azure-500"></span>
            </button>

            <nav class="mt-16 flex flex-col gap-8 text-[22px] font-medium leading-none">
                @foreach($menu as $item)
                    <a
                        href="{{ $item['href'] }}"
                        @if(!empty($item['anchor'])) data-anchor-link @endif
                        @click="menuOpen = false"
                        @if(!empty($item['navigate'])) wire:navigate @endif
                        class="{{ !empty($item['navigate']) ? 'js-page-transition' : '' }} transition-opacity hover:opacity-60"
                    >
                        {{ $item['title'] }}
                    </a>
                @endforeach
            </nav>

            <div class="mt-auto">
                <x-Ui.link class="w-full justify-center" type="teal">
                    Связаться с нами
                </x-Ui.link>
            </div>
        </div>
    </div>
</header>
