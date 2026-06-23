@props([
    'article',
    'color' => 'white'
])
@php
    $classes = match ($color) {
        'white' => [
            'category' => 'text-white/60',
            'text' => 'text-white',
        ],
        'dark' => [
            'category' => 'text-black/40',
            'text' => 'text-black',
        ],
    };
@endphp
<a {{ $attributes->merge(['class' => 'lg:max-w-[290px]']) }} href="{{route('portal.article', $article->slug)}}" wire:navigate>
    <img src="{{$article->getFirstMediaUrl('cover')}}" alt="Blog article" class="w-[443px] h-[296px] lg:min-w-0 lg:min-h-0 lg:w-full lg:h-[219px] min-w-[443px] min-h-[296px] object-cover rounded-lg"/>

    <!-- Content -->
    <div class="pt-4">
                    <span
                        class="mx-auto py-4 text-sm text-center {{$classes['category']}} uppercase w-fit md:text-[11px] md:mb-3">
                    {{ $article->category->name }}/{{ $article['date'] }}
                </span>
        <h3 class="{{$classes['text']}} text-[22px] font-semibold mb-2 max-w-[443px] line-clamp-2 md:text-[17px] md:mb-3 md:mt-3">
            {{$article['title']}}
        </h3>
        <p class="{{$classes['text']}} line-clamp-3 md:text-sm">{{$article['description']}}</p>
    </div>
</a>
