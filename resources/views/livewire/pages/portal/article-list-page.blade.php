<section class="flex-1 container mt-32">
    <div class="fixed min-w-[100vw]">
        <img src="/fixed/welcome-vector-1.svg"
             class="pointer-events-none absolute left-[56%] top-0 -translate-x-1/2 blur-[200px]"
             alt="">

        <img src="/fixed/welcome-vector-2.svg"
             class="pointer-events-none absolute right-[12%] top-[45vh] z-10 blur-[200px]"
             alt="">
    </div>
    <h2 class="text-white mb-8">Исследования и аналитика</h2>
    <div class="flex transition-all duration-700 ease-out gap-2 mb-16">
        <button
            type="button"
            wire:click="showAllArticles"
            @class([
                'font-semibold leading-none py-3 border-gradient relative z-40 !rounded-3xl p-5 transition-all duration-700 ease-out',
                'bg-bright-40 text-azure-400' => empty($activeCategoryIds),
                'bg-white/5 hover:bg-white/10 text-white' => !empty($activeCategoryIds),
            ])
        >
            Все статьи
        </button>

        @foreach($categories as $i => $category)
            <button
                type="button"
                wire:click="toggleCategory({{ $category->id }})"
                x-data="revealOnScroll({{ $i * 70 }})"
                :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
                @class([
                    'font-semibold leading-none py-3 border-gradient relative z-40 !rounded-3xl p-5 transition-all duration-700 ease-out',
                    'bg-bright-40 text-azure-400' => in_array($category->id, $activeCategoryIds, true),
                    'bg-white/5 hover:bg-white/10 text-white' => !in_array($category->id, $activeCategoryIds, true),
                ])
            >
                {{ $category->name }}
            </button>
        @endforeach
    </div>

    <div
         class="transition-all duration-700 ease-out flex flex-col gap-4 container pb-[180px] border-b border-bright-40/40 mb-6">
        <div class="grid grid-cols-3 gap-x-4 gap-y-16 md:flex-col">
            @foreach($articles as $i => $article)
                <div
                    x-data="revealOnScroll({{ $i * 70 }})"
                    :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
                    class="transition-all duration-700 ease-out"
                    wire:key="article-wrapper-{{ $article->id }}"
                >
                    <x-article-card :article="$article"/>
                </div>
            @endforeach
        </div>
    </div>
</section>
