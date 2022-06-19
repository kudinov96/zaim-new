<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $id
 * @property string $slug_full
 * @property int    $model_id
 * @property string $model
 *
 * @property string $slug_single
 */
class Slug extends Model
{
    protected $table = "slug";

    protected $guarded = [
        "id",
    ];

    public $timestamps = false;

    protected function slugSingle(): Attribute
    {
        return Attribute::make(
            get: fn () => last(explode("/", $this->slug_full)),
        );
    }
}
