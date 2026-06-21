<?php

namespace App\View\Components\IndexPageBlocks;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Analytics extends Component
{
    public $articles;
    /**
     * Create a new component instance.
     */
    public function __construct($articles)
    {
        $this->articles = $articles;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.index-page-blocks.analytics');
    }
}
