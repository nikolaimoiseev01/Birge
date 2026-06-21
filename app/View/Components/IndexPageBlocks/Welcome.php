<?php

namespace App\View\Components\IndexPageBlocks;

use App\Models\Article;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Welcome extends Component
{
    public $firstArticle;
    /**
     * Create a new component instance.
     */
    public function __construct(Article $firstArticle)
    {
        $this->firstArticle = $firstArticle;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.index-page-blocks.welcome');
    }
}
