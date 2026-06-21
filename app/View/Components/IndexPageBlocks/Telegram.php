<?php

namespace App\View\Components\IndexPageBlocks;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Telegram extends Component
{
    public array $telegramPosts;
    /**
     * Create a new component instance.
     */
    public function __construct($telegramPosts)
    {
        $this->telegramPosts = $telegramPosts;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.index-page-blocks.telegram');
    }
}
