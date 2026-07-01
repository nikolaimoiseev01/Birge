<?php

namespace App\Livewire\Pages\Portal;

use App\Models\Article;
use Livewire\Component;

class ArticlePage extends Component
{
    public Article $article;
    public $otherArticles;

    public function render()
    {
        return view('livewire.pages.portal.article-page');
    }

    public function mount($id) {
        $locale = app()->getLocale();
        $this->article = Article::query()->with('category')->where("id", $id)->first();
        $this->otherArticles = Article::query()->with('category')->where('id', '!=', $this->article->id)->take(3)->get();
    }
}
