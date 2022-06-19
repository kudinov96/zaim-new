<?php

namespace App\Actions\Traits;

use App\Rules\SlugUnique;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

trait SlugGenerator
{
    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function generateSlug(string $title, Model $item, ?string $slug = null): void
    {
        $model = $item->getMorphClass();

        $item->slug      = $slug ?? Str::slug($title);
        $item->slug_full = $model::generateSlugFull($item, $item->slug);

        $validator = Validator::make([
            "slug_full" => $item->slug_full,
            "model"     => $model,
        ], [
            "slug_full" => new SlugUnique($item->id),
        ]);

        $validator->validate();
    }
}
