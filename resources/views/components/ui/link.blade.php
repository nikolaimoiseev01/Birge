@props([
    'type' => 'mint',
    'href' => '#',
    'navigate' => true
])

@php
    $gradients = [
        'mint' => 'bg-[linear-gradient(90deg,#d8f5c7_0%,#57c9c5_100%)] text-[#082329]',
        'teal' => 'bg-[linear-gradient(90deg,#8dd5c2_0%,#1298a8_100%)] text-white',
    ];

    $gradient = $gradients[$type] ?? $gradients['mint'];

    $text = trim((string) $slot);
    $letters = mb_str_split($text);

    $duration = 450;
    $delay = 16;
    $iconDelay = 0;
    $textDelayOffset = isset($icon) ? 1 : 0;
@endphp

<a
    href="{{ $href }}"
    @if($navigate) wire:navigate @endif
    x-data="{ active: false, ready: true }"
    @mouseenter="
        ready = false;
        active = false;

        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                ready = true;
                active = true;
            });
        });
    "
    {{ $attributes->merge([
        'class' => "
            inline-flex
            items-center
            justify-center
            rounded-full
            px-8
            py-4
            font-medium
            leading-none
            overflow-hidden
            transition-all
            duration-300
            hover:scale-[1.02]
            hover:shadow-[0_10px_40px_rgba(0,0,0,.15)]
            {$gradient}
        "
    ]) }}
>
    <span class="relative flex h-[1em] items-center overflow-hidden leading-none tracking-[-0.08em] pr-[0.12em]">

        @isset($icon)
            <span class="relative mr-[10px] block h-[1em] overflow-hidden leading-none tracking-normal shrink-0">
                <span
                    class="block will-change-transform [backface-visibility:hidden] transform-gpu"
                    :class="[
                        ready ? 'transition-transform duration-[{{ $duration }}ms] ease-[cubic-bezier(.22,1,.36,1)]' : '!transition-none',
                        active ? '-translate-y-full' : 'translate-y-0'
                    ]"
                    style="transition-delay: {{ $iconDelay }}ms"
                >
                    {{ $icon }}
                </span>

                <span
                    class="absolute left-0 top-0 block will-change-transform [backface-visibility:hidden] transform-gpu"
                    :class="[
                        ready ? 'transition-transform duration-[{{ $duration }}ms] ease-[cubic-bezier(.22,1,.36,1)]' : '!transition-none',
                        active ? 'translate-y-0' : 'translate-y-full'
                    ]"
                    style="transition-delay: {{ $iconDelay }}ms"
                >
                    {{ $icon }}
                </span>
            </span>
        @endisset

        <span class="relative block h-[1em] overflow-hidden leading-none pr-[0.12em]">
            <span class="block whitespace-nowrap pr-[0.04em]" aria-label="{{ $text }}">
                @foreach($letters as $i => $letter)
                    <span
                        aria-hidden="true"
                        class="inline-block mr-[-0.04em] will-change-transform [backface-visibility:hidden] transform-gpu"
                        :class="[
                            ready ? 'transition-transform duration-[{{ $duration }}ms] ease-[cubic-bezier(.22,1,.36,1)]' : '!transition-none',
                            active ? '-translate-y-full' : 'translate-y-0'
                        ]"
                        style="transition-delay: {{ ($i + $textDelayOffset) * $delay }}ms"
                    >{!! $letter === ' ' ? '&nbsp;' : e($letter) !!}</span>
                @endforeach
            </span>

            <span class="absolute left-0 top-0 block whitespace-nowrap pr-[0.04em]" aria-hidden="true">
                @foreach($letters as $i => $letter)
                    <span
                        class="inline-block mr-[-0.04em] will-change-transform [backface-visibility:hidden] transform-gpu"
                        :class="[
                            ready ? 'transition-transform duration-[{{ $duration }}ms] ease-[cubic-bezier(.22,1,.36,1)]' : '!transition-none',
                            active ? 'translate-y-0' : 'translate-y-full'
                        ]"
                        style="transition-delay: {{ ($i + $textDelayOffset) * $delay }}ms"
                    >{!! $letter === ' ' ? '&nbsp;' : e($letter) !!}</span>
                @endforeach
            </span>
        </span>
    </span>
</a>
