<?php

namespace App\Models\Traits;

use App\Models\Slug;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
* @property string $slug_single
* @property string $slug_full
*/
trait SlugFull
{
    public function slug(): HasOne
    {
        return $this->hasOne(Slug::class, "model_id")->where("model", self::class);
    }

    public function getClassName(): string
    {
        return substr(strrchr(self::class, "\\"), 1);
    }

    public function canUpdateSlug(): bool
    {
        return Carbon::now() > $this->created_at->addHours(2);
    }

    protected function initializeAppendAttributeTrait(): void
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
}
