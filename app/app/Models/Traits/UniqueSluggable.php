<?php

namespace App\Models\Traits;

use App\Models\Page;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait UniqueSluggable
{
    use Sluggable, SluggableScopeHelpers;

    public function scopeWithUniqueSlugConstraints(Builder $query, Model $model, string $attribute, array $config, string $slug): Builder
    {
        $query->unionAll(Page::where($attribute, $slug)->select([$attribute, 'id']));

        return $query;
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }
}
