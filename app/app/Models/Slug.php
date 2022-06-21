<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    protected static function generateSlugFull(string $title, ?Model $parent = null, ?array &$arr = []): string
    {
        $arr[]  = Str::slug($title);

        if ($parent) {
            self::generateSlugFull($parent->slug_single, $parent->parent, $arr);
        }

        return implode("/", array_reverse($arr));
    }
}
