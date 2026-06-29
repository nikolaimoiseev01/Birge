<div
    wire:ignore.self
    x-data="expertPopup()"
    x-on:open-expert.window="open($event.detail.id)"
    x-on:keydown.escape.window="close()"
    x-cloak
>
    <style>
        @media (hover: hover) and (pointer: fine) {
            .desktop-hover-bg:hover {
                background-color: #dbe9dc;
            }
        }
    </style>
    <template x-teleport="body">
        <div>
            <div
                x-show="isOpen"
                class="fixed inset-0 z-[9999] overflow-hidden md:overflow-auto bg-[#eef6ea] text-[#285d59]"
                x-transition:enter="transition duration-500 ease-out"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition duration-[700ms] ease-in-out"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
            >
                <button
                    @click="close()"
                    class="gradient-border-circle-about z-50 md:fixed absolute right-10 top-10 flex h-12 w-12 items-center justify-center rounded-full bg-mint-900/10 transition hover:bg-mint-900/20">
                    <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="7.77734" y="9.19249" width="2" height="24" transform="rotate(-45 7.77734 9.19249)"
                              fill="#295A57"/>
                        <rect x="9.19141" y="26.1627" width="2" height="24" transform="rotate(-135 9.19141 26.1627)"
                              fill="#295A57"/>
                    </svg>
                </button>

                <div class="grid min-h-screen grid-cols-[48%_52%] md:grid-cols-1">
                    <div class="relative flex flex-col border-r border-[#b6d8d0] md:border-r-0">
                        <div
                            class="flex flex-1 items-center justify-center px-16 py-20 md:px-4 md:pt-48 md:relative md:bottom-8">
                            <div
                                x-ref="targetImageBox"
                                class="h-[530px] w-[480px] overflow-hidden rounded xl:h-[420px] xl:w-[420px] md:h-[360px] md:w-full"
                            >
                                <img
                                    x-ref="staticImage"
                                    class="h-full w-full object-cover opacity-0 transition-opacity duration-150"
                                    alt=""
                                >
                            </div>
                        </div>

                        <div
                            class="grid grid-cols-2 border-t border-[#b6d8d0] md:fixed md:bottom-0 md:w-full md:bg-[#eef6ea] z-[99]">
                            <button
                                type="button"
                                @click="change('prev')"
                                class="flex items-center justify-center min-h-[124px] md:min-h-[90px] border-r border-[#b6d8d0] text-5xl font-light transition   desktop-hover-bg"
                            >
                                <svg width="50" height="19" viewBox="0 0 50 19" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M0.366116 10.0888C-0.12204 9.60068 -0.12204 8.80923 0.366116 8.32107L8.32107 0.366121C8.80922 -0.122034 9.60068 -0.122034 10.0888 0.366121C10.577 0.854277 10.577 1.64573 10.0888 2.13389L3.01777 9.20496L10.0888 16.276C10.577 16.7642 10.577 17.5556 10.0888 18.0438C9.60068 18.5319 8.80922 18.5319 8.32107 18.0438L0.366116 10.0888ZM49.25 9.20496V10.455L1.25 10.455V9.20496V7.95496L49.25 7.95496V9.20496Z"
                                        fill="#1E4644"/>
                                </svg>

                            </button>

                            <button
                                type="button"
                                @click="change('next')"
                                class="flex items-center min-h-[124px] md:min-h-[90px] justify-center text-5xl font-light transition  desktop-hover-bg"
                            >
                                <svg width="50" height="19" viewBox="0 0 50 19" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M48.8839 10.0888C49.372 9.60068 49.372 8.80923 48.8839 8.32107L40.9289 0.366121C40.4408 -0.122034 39.6493 -0.122034 39.1612 0.366121C38.673 0.854277 38.673 1.64573 39.1612 2.13389L46.2322 9.20496L39.1612 16.276C38.673 16.7642 38.673 17.5556 39.1612 18.0438C39.6493 18.5319 40.4408 18.5319 40.9289 18.0438L48.8839 10.0888ZM0 9.20496L0 10.455L48 10.455V9.20496V7.95496L0 7.95496L0 9.20496Z"
                                        fill="#1E4644"/>
                                </svg>

                            </button>
                        </div>
                    </div>

                    <div class="flex items-center px-20 pb-20 md:px-4 md:py-10 bg-bright-500">
                        <div
                            class="flex h-[530px] w-full items-center  xl:h-[420px] md:!h-auto md:min-h-[360px] flex-col"
                            x-show="contentVisible"
                            x-transition:enter="transition duration-700 delay-50 ease-out"
                            x-transition:enter-start="translate-y-8 opacity-0"
                            x-transition:enter-end="translate-y-0 opacity-100"
                        >
                            @if($expert)
                                <div class=" md:px-0 mr-auto md:pb-[110px]">
                                    <h2 class="mb-6 text-mint-900">
                                        {{ $expert->name }}
                                    </h2>

                                    <p class="mb-14 max-w-[360px] text-lg leading-[120%] text-azure-600/60">
                                        {{ $expert->description_short }}
                                    </p>

                                    <div class="mb-14 max-w-[588px] text-lg leading-[120%] text-azure-600">
                                        {!! $expert->description !!}
                                    </div>

                                    @if($expert->email)
                                        <a
                                            href="mailto:{{ $expert->email }}"
                                            class="inline-flex items-center gap-3 text-xl text-mint-900 transition hover:opacity-60"
                                        >
                                            <svg width="20" height="16" viewBox="0 0 20 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M18 0H2C0.9 0 0.00999999 0.9 0.00999999 2L0 14C0 15.1 0.9 16 2 16H18C19.1 16 20 15.1 20 14V2C20 0.9 19.1 0 18 0ZM17.6 4.25L10.53 8.67C10.21 8.87 9.79 8.87 9.47 8.67L2.4 4.25C2.29973 4.19371 2.21192 4.11766 2.14189 4.02645C2.07186 3.93525 2.02106 3.83078 1.99258 3.71937C1.96409 3.60796 1.9585 3.49194 1.97616 3.37831C1.99381 3.26468 2.03434 3.15581 2.09528 3.0583C2.15623 2.96079 2.23632 2.87666 2.33073 2.811C2.42513 2.74533 2.53187 2.69951 2.6445 2.6763C2.75712 2.65309 2.87328 2.65297 2.98595 2.67595C3.09863 2.69893 3.20546 2.74453 3.3 2.81L10 7L16.7 2.81C16.7945 2.74453 16.9014 2.69893 17.014 2.67595C17.1267 2.65297 17.2429 2.65309 17.3555 2.6763C17.4681 2.69951 17.5749 2.74533 17.6693 2.811C17.7637 2.87666 17.8438 2.96079 17.9047 3.0583C17.9657 3.15581 18.0062 3.26468 18.0238 3.37831C18.0415 3.49194 18.0359 3.60796 18.0074 3.71937C17.9789 3.83078 17.9281 3.93525 17.8581 4.02645C17.7881 4.11766 17.7003 4.19371 17.6 4.25Z"
                                                    fill="#295A57"/>
                                            </svg>

                                            <span class="relative inline-block">
        {{ $expert->email }}
        <span class="absolute left-0 right-0 bottom-0 h-px bg-current"></span>
    </span>
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <img
                wire:ignore
                x-ref="flyingImage"
                class="pointer-events-none fixed z-[10000] object-cover opacity-0"
                alt=""
            >
        </div>
    </template>
</div>
@script
<script>
    Alpine.data('expertPopup', () => ({
        isOpen: false,
        contentVisible: false,
        isClosing: false,
        currentId: null,
        duration: 700,
        scrollY: 0,

        lockScroll() {
            this.scrollY = window.scrollY;

            document.documentElement.style.overflow = 'hidden';
            document.body.style.overflow = 'hidden';
        },

        unlockScroll() {
            document.documentElement.style.overflow = '';
            document.body.style.overflow = '';

            window.scrollTo(0, this.scrollY);
        },

        async open(id) {
            if (this.$refs.staticImage) {
                this.$refs.staticImage.src = '';
                this.$refs.staticImage.style.opacity = '0';
            }

            this.isClosing = false;
            this.currentId = id;

            const sourceImage = document.querySelector(`[data-expert-image="${id}"]`);
            if (!sourceImage) return;

            const from = sourceImage.getBoundingClientRect();

            this.isOpen = true;
            this.contentVisible = false;

            this.lockScroll();

            const flying = this.$refs.flyingImage;

            flying.src = sourceImage.src;
            flying.style.transition = 'none';
            flying.style.opacity = '1';
            flying.style.borderRadius = '4px';
            flying.style.objectFit = 'cover';

            this.setFlyingImageRect(from);

            await this.$nextTick();

            const to = this.$refs.targetImageBox.getBoundingClientRect();

            requestAnimationFrame(() => {
                flying.style.transition = `
                top ${this.duration}ms cubic-bezier(.22,1,.36,1),
                left ${this.duration}ms cubic-bezier(.22,1,.36,1),
                width ${this.duration}ms cubic-bezier(.22,1,.36,1),
                height ${this.duration}ms cubic-bezier(.22,1,.36,1),
                border-radius ${this.duration}ms cubic-bezier(.22,1,.36,1)
            `;

                this.setFlyingImageRect(to);
                setTimeout(() => {
                    if (window.innerWidth < 768) {
                        this.$refs.staticImage.src = sourceImage.src;
                        this.$refs.staticImage.style.opacity = '1';

                        flying.style.transition = 'none';
                        flying.style.opacity = '0';
                    }
                }, this.duration);
            });

            await this.$wire.loadExpert(id);

            this.contentVisible = true;
        },

        close() {
            if (this.isClosing) return;

            this.isClosing = true;
            this.contentVisible = false;

            const flying = this.$refs.flyingImage;

            flying.style.transition = 'opacity 200ms ease-in-out';
            flying.style.opacity = '0';

            setTimeout(() => {
                this.isOpen = false;
                this.isClosing = false;
                this.currentId = null;

                this.unlockScroll();

                flying.style.transition = 'none';
                flying.style.opacity = '0';
            }, 200);
        },

        async change(direction) {
            if (this.isClosing) return;

            this.contentVisible = false;

            const flying = this.$refs.flyingImage;
            const isMobile = window.innerWidth < 768;

            if (!isMobile) {
                flying.style.transition = 'opacity 300ms ease-in-out';
                flying.style.opacity = '0';
            }

            await new Promise(resolve => setTimeout(resolve, 30));

            const result = direction === 'next'
                ? await this.$wire.nextExpert()
                : await this.$wire.prevExpert();

            await this.$nextTick();

            this.currentId = result.id;

            if (isMobile && result.imageUrl) {
                this.$refs.staticImage.style.opacity = '0';

                requestAnimationFrame(() => {
                    this.$refs.staticImage.src = result.imageUrl;

                    requestAnimationFrame(() => {
                        this.$refs.staticImage.style.opacity = '1';
                    });
                });

                flying.style.transition = 'none';
                flying.style.opacity = '0';

                setTimeout(() => {
                    this.contentVisible = true;
                }, 150);

                return;
            }

            if (result.imageUrl) {
                flying.src = result.imageUrl;
            }

            const to = this.$refs.targetImageBox.getBoundingClientRect();

            this.setFlyingImageRect(to);

            flying.style.transition = 'opacity 300ms ease-in-out';
            flying.style.opacity = '1';

            setTimeout(() => {
                this.contentVisible = true;
            }, 10);
        },

        setFlyingImageRect(rect) {
            const flying = this.$refs.flyingImage;

            flying.style.top = `${rect.top}px`;
            flying.style.left = `${rect.left}px`;
            flying.style.width = `${rect.width}px`;
            flying.style.height = `${rect.height}px`;
            flying.style.borderRadius = '4px';
        },
    }));
</script>
@endscript
