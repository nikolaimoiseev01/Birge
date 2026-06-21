<section class="bg-mint-200 flex-1">
    <style>
        .article-content p {
            max-width: 648px;
            margin: auto;
        }

        .article-content img {
            margin: auto;
        }

        .attachment__caption {
            display: none;
        }
    </style>
    @section('title')
        {{$article['title']}}
    @endsection
    <div class="flex flex-col mb-24 container">
        <div class="w-full py-12">
            <div class="w-full article-content flex flex-col items-center ">
                <div x-data="revealOnScroll()"
                     :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
                     class="grid grid-cols-3  mb-6 w-full transition-all duration-700 ease-out">
                    <a
                        wire:navigate
                        href="{{ route('portal.article_list') }}"
                        class="group flex w-fit items-center gap-2 text-lg"
                    >
                        <svg
                            class="transition-transform duration-300 ease-out group-hover:-translate-x-1"
                            width="18"
                            height="10"
                            viewBox="0 0 18 10"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M17.8486 4.92427H0.848633M5.34863 9.42427L0.848633 4.92427L5.34863 0.424271"
                                stroke="currentColor"
                                stroke-width="1.2"
                            />
                        </svg>

                        <span>Назад</span>
                    </a>

                    <span
                        class="mx-auto  px-3 py-2 text-sm text-center text-azure-500/40 uppercase w-fit">
                    {{ $article->category->name }}/{{ $article['date'] }}
                </span>
                    <div></div>
                </div>

                <h1                     x-data="revealOnScroll()"
                                        :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
                    class="mb-8 max-w-5xl leading-none text-center transition-all duration-700 ease-out">{{$article['title']}}</h1>
                <span                    x-data="revealOnScroll()"
                                         :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
                                         class=""
                      class="transition-all duration-700 ease-out max-w-2xl text-lg font-normal text-center">{{$article['description']}}</span>
            </div>
        </div>

        <img src="{{$article->getFirstMediaUrl('cover')}}" class="w-full rounded-lg max-h-[642px] object-cover" alt="">

    </div>
    <x-article-content :article="$article"/>

    <div                     x-data="revealOnScroll()"
                             :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
                            class="transition-all duration-700 ease-out flex flex-col gap-4 container pb-[150px] border-b border-black/40 mb-6">
        <h2 class="text-nowrap md:text-center text-black mb-10">Другие статьи</h2>
        <div class="flex gap-4 md:flex-col">
            @foreach($otherArticles as $article)
                <x-article-card color="dark" :article="$article"/>
            @endforeach
        </div>
    </div>
</section>
