<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Expert extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $casts = [
        'name' => 'array',
        'description_short' => 'array',
        'description' => 'array',
    ];

    public function getLocalizedValue($column)
    {
        $value = $this->{$column};
        if (is_array($value)) {
            $locale = app()->getLocale();
            return $value[$locale] ?? $value['ru'] ?? reset($value) ?? '';
        }
        return $value;
    }

}
