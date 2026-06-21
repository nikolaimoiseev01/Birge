<div
    x-show="preloader"
    x-transition:leave="transition-all duration-700 ease-in-out"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-[9999] flex items-center justify-center bg-[#071b25]"
>
    <div class="flex flex-col items-center gap-6 text-[#a8e6bf]">
        <div class="text-3xl font-semibold tracking-[-0.08em]">
            Birge
        </div>

        <div class="h-px w-56 overflow-hidden bg-white/15">
            <div
                class="h-full bg-[#a8e6bf] transition-all duration-700 ease-out"
                :style="`width:${progress}%`"
            ></div>
        </div>

        <p class="text-xs uppercase tracking-[0.35em] text-white/40">
            Загружаю
        </p>
    </div>
</div>

@push('scripts')

    <script>
        function pageApp() {
            return {
                preloader: true,
                progress: 0,

                init() {
                    document.body.style.overflow = 'hidden';

                    setTimeout(() => this.progress = 40, 150);
                    setTimeout(() => this.progress = 75, 500);
                    setTimeout(() => this.progress = 100, 900);

                    setTimeout(() => {
                        this.preloader = false;
                        document.body.style.overflow = '';
                    }, 1250);
                },
            };
        }

    </script>
@endpush
