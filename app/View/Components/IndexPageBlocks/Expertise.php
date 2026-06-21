<?php

namespace App\View\Components\IndexPageBlocks;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Expertise extends Component
{
    public $expertise;

    /**
     * Create a new component instance.
     */
    public function __construct($expertise)
    {
        $this->expertise = $expertise;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.index-page-blocks.expertise');
    }
}
