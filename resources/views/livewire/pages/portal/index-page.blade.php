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

<div
    class="overflow-x-hidden text-[#071b25]"
>

    <div class="fixed min-w-[100vw]">
        <img src="/fixed/welcome-vector-1.svg"
             class="pointer-events-none absolute left-[56%] top-0 -translate-x-1/2 blur-[200px]"
             alt="">

        <img src="/fixed/welcome-vector-2.svg"
             class="pointer-events-none absolute right-[12%] top-[45vh] z-10 blur-[200px]"
             alt="">
    </div>

    <x-index-page-blocks.welcome :first-article="$articles[0]"/>

    <x-index-page-blocks.experts :experts="$experts"/>

    <div class="h-48 bg-gradient-to-b from-azure-500 to-bright-400 relative z-40"></div>

    <x-index-page-blocks.expertise :expertise="$expertise"/>

{{--    <x-index-page-blocks.analytics :articles="$articles"/>--}}

{{--    <div class="h-48 bg-gradient-to-b to-[#16343F] from-bright-400 relative z-40"></div>--}}

{{--    <x-index-page-blocks.telegram :telegramPosts="$telegramPosts"/>--}}

</div>
