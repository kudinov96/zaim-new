<?php

namespace App\Models\Traits;

use App\Models\Slug;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

/**
* @property string $slug_single
* @property string $slug_full
*/
trait SlugFull
{
    public function initializeAppendAttributeTrait(): void
    {
        $this->append("slug_single");
        $this->append("slug_full");
    }

    protected function slugSingle(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->slug->slug_single,
        );
    }

    protected function slugFull(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->slug->slug_full,
        );
    }

    public function slug(): HasOne
    {
        return $this->hasOne(Slug::class, "model_id")->where("model", self::class);
    }

    public function canUpdateSlug(): bool
    {
        return Carbon::now() > $this->created_at->addHours(2);
    }

    protected static function generateSlugFull(string $title, ?int $parent_id = null, ?array &$arr = []): string
    {
        $arr[] = Str::slug($title);

        if ($parent_id) {
            $parent = self::find($parent_id);

            if ($parent) {
                self::generateSlugFull($parent->slug_single, $parent->parent_id, $arr);
            }
        }

        return implode("/", array_reverse($arr));
    }
}
