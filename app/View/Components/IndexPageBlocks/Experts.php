<?php

namespace App\View\Components\IndexPageBlocks;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Experts extends Component
{
    /**
     * Create a new component instance.
     */
    public $experts;
    public function __construct($experts)
    {
        $this->experts = $experts;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.index-page-blocks.experts');
    }
}
