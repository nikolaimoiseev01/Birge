<?php

namespace App\Livewire\Pages\Portal;

use App\Models\Article;
use App\Models\ArticleCategory;
use Livewire\Component;

class ArticleListPage extends Component
{
    public $articles;
    public $categories;

    public array $activeCategoryIds = [];

    public function render()
    {
        return view('livewire.pages.portal.article-list-page');
    }

    public function mount(): void
    {
        $this->categories = ArticleCategory::query()
            ->has('articles')
            ->get();

        $this->loadArticles();
    }

    public function toggleCategory(int $categoryId): void
    {
        if (in_array($categoryId, $this->activeCategoryIds, true)) {
            $this->activeCategoryIds = array_values(
                array_diff($this->activeCategoryIds, [$categoryId])
            );
        } else {
            $this->activeCategoryIds[] = $categoryId;
        }

        $this->loadArticles();
    }

    public function showAllArticles(): void
    {
        $this->activeCategoryIds = [];

        $this->loadArticles();
    }

    private function loadArticles(): void
    {
        $this->articles = Article::query()
            ->with('category')
            ->when(!empty($this->activeCategoryIds), function ($query) {
                $query->whereIn('article_category_id', $this->activeCategoryIds);
            })
            ->get();
    }
}
