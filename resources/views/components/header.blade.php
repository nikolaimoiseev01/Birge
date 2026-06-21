<header
    x-data="{
        isHome: @js(request()->routeIs('portal.index') || request()->routeIs('portal.article_list')),
        ...( @js(request()->routeIs('portal.index'))
            ? revealOnScroll()
            : { shown: true }
        )
    }"
    :class="[
        shown ? 'translate-y-0 opacity-100' : 'translate-y-6 opacity-0',
        isHome ? 'absolute bg-transparent' : 'relative bg-mint-200'
    ]"
    class="z-50 mx-auto flex w-full py-5 transition-[opacity,transform] duration-700 ease-out"
>
    <div class="flex justify-between container">
        <x-logo/>

        <div class="flex gap-10">
            <nav
                :class="[
                    isHome ? 'text-white' : 'text-azure-500'
                ]"
                x-data="{ hovered: null }" class="flex items-center font-semibold gap-10 lg:hidden">
                <a href="#about" @mouseenter="hovered = 'about'" @mouseleave="hovered = null"
                   :class="hovered && hovered !== 'about' ? 'opacity-40' : 'opacity-100'"
                   class="transition-opacity duration-500">О компании</a>

                <a href="#team" @mouseenter="hovered = 'team'" @mouseleave="hovered = null"
                   :class="hovered && hovered !== 'team' ? 'opacity-40' : 'opacity-100'"
                   class="transition-opacity duration-500">Команда</a>

                <a href="#services" @mouseenter="hovered = 'services'" @mouseleave="hovered = null"
                   :class="hovered && hovered !== 'services' ? 'opacity-40' : 'opacity-100'"
                   class="transition-opacity duration-500">Услуги</a>

                <a href="{{route('portal.article_list')}}" @mouseenter="hovered = 'articles'" @mouseleave="hovered = null"
                   :class="hovered && hovered !== 'articles' ? 'opacity-40' : 'opacity-100'"
                   wire:navigate class="js-page-transition transition-opacity duration-500">Статьи</a>

                <a href="#platform" @mouseenter="hovered = 'platform'" @mouseleave="hovered = null"
                   :class="hovered && hovered !== 'platform' ? 'opacity-40' : 'opacity-100'"
                   class="transition-opacity duration-500">Платформа Birge</a>
            </nav>

            <div class="flex items-center gap-8">
                <x-Ui.link type="teal">Связаться с нами</x-Ui.link>

                <div x-data="{ open: false, lang: 'Ru' }" class="relative">
                    <button
                        type="button"
                        @click="open = !open"
                        class="flex items-center gap-1 text-base text-white transition hover:text-white"
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
                        <button
                            type="button"
                            @click="lang = 'Kz'; open = false"
                            class="text-left text-base font-semibold transition hover:text-[#8dd5c2]"
                        >
                            Kz
                        </button>

                        <button
                            type="button"
                            @click="lang = 'En'; open = false"
                            class="text-left text-base font-semibold transition hover:text-[#8dd5c2]"
                        >
                            En
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

</header>
