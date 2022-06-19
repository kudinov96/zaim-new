<?php

namespace App\Actions\Slug;

use App\Models\Slug;
use Illuminate\Database\Eloquent\Model;

class CreateSlug
{
    public function handle(Model $model, string $slug_full)
    {
        $item            = new Slug();
        $item->slug_full = $slug_full;
        $item->model_id  = $model->id;
        $item->model     = $model->getMorphClass();

        $item->save();

        return $item;
    }
}
