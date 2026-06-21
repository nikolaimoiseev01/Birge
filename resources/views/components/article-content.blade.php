<div class="container mx-auto flex max-w-7xl pt-10 mb-[180px] gap-8">

    <!-- Main Article -->
    <main class="w-2/3 space-y-12 lg:w-full">
        <article class="space-y-12 pr-6">
            @foreach($article['content'] as $topic)
                <div
                    x-data="revealOnScroll()"
                    :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
                    class="transition-all duration-700 ease-out"
                >
                    <h2 id="{{Str::slug($topic['title'])}}" class="text-black font-semibold text-2xl scroll-mt-12 mb-6">{{$topic['title']}}</h2>
                    <p class="text-xl">
                        {!! $topic['text'] !!}
                    </p>

                </div>
            @endforeach
        </article>
    </main>

    <!-- Table of Contents -->
    <aside class="w-1/3 lg:hidden">
        <div class="sticky top-20 p-4 ">
            <h3 class="text-azure-500/40 mb-4 border-t uppercase border-azure-500/20">Содержание</h3>
            <nav class="space-y-2 mb-10">
                @foreach($article['content'] as $topic)
                    <a href="#{{Str::slug($topic['title'])}}"
                       class="block hover:underline text-azure-500/40">
                        {{$topic['title']}}
                    </a>
                @endforeach
            </nav>
        </div>
    </aside>
</div>

<script>
    let tocObserver = null;

    function setupTocObserver() {
        if (tocObserver) tocObserver.disconnect();

        const $tocLinks = document.querySelectorAll('aside nav a');

        tocObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const id = entry.target.id;

                    $tocLinks.forEach(link => {
                        const isActive = link.getAttribute('href') === `#${id}`;
                        link.classList.toggle('text-black', isActive);
                    });
                }
            });
        }, {
            rootMargin: '0px 0px -70% 0px',
            threshold: 0
        });

        document.querySelectorAll('main h2[id]').forEach(h2 => {
            tocObserver.observe(h2);
        });
    }

    window.addEventListener('load', setupTocObserver);

    document.addEventListener('livewire:navigated', () => {
        setTimeout(setupTocObserver, 100);
    });
</script>
