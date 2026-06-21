<section id="articles" class="bg-mint-200 pb-20 sm:px-4 relative z-40">
    <div class="mx-auto container">
        <h2
            x-data="revealOnScroll()"
            :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
            class="mb-11 text-azure-500 transition-all duration-700 ease-out"
        >
            Исследования и аналитика
        </h2>

        <div class="divide-y ">
            @foreach($articles as $i => $article)
                <a
                    href="{{route('portal.article', $article['slug'])}}"
                    wire:navigate
                    x-data="revealOnScroll({{ $i * 70 }})"
                    :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
                    class="border-y border-[#082329]/15 first:border-t-0 grid grid-cols-[150px_1fr_1.15fr] gap-10 py-5 transition-all duration-700 ease-out hover:bg-white/35 lg:grid-cols-[110px_1fr] lg:gap-6 md:grid-cols-1"
                >
                    <time class="text-lg text-[#1E1E1E]/50">
                        {{ $article['date'] }}
                    </time>

                    <h3 class="text-2xl text-azure-600 font-semibold leading-tight tracking-[-0.03em] line-clamp-2">
                        {{ $article['title'] }}
                    </h3>

                    <p class="text-lg  text-azure-600 leading-relaxed text-[#082329]/65 lg:col-start-2 md:col-start-auto line-clamp-3">
                        {{ $article['description'] }}
                    </p>
                </a>
            @endforeach
        </div>

        <x-Ui.link href="{{route('portal.article_list')}}" type="teal">Смотреть все статьи</x-Ui.link>
    </div>
</section>
