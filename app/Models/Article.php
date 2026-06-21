<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property int $id
 * @property string $title
 * @property int $article_category_id
 * @property string $slug
 * @property string $description
 * @property array $content
 * @property \Illuminate\Support\Carbon $date
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @property-read ArticleCategory $category
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 */

class Article extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $casts = [
        'content' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(
            ArticleCategory::class,
            'article_category_id',
            'id'
        );
    }
}
