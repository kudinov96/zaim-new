<?php

namespace App\Actions\Slug;

use Illuminate\Database\Eloquent\Model;

class UpdateSlug
{
    public function handle(Model $model, string $slug_full)
    {
        $item            = $model->slug;
        $item->slug_full = $slug_full;
        $item->model_id  = $model->id;
        $item->model     = $model->getMorphClass();

        $item->save();

        return $item;
    }
}
