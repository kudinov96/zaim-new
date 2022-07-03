<?php

namespace App\Models\Traits;

use App\Models\Page;
use App\Models\Slug;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

/**
* @property string $slug_single
* @property string $slug_full
*/
trait Sluggable
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

    protected static function booted(): void
    {
        static::created(function ($post) {
            $post->generateSitemap();
        });

        static::updated(function($post) {
            $post->generateSitemap();
        });

        static::deleted(function($post) {
            $post->generateSitemap();
        });
    }

    private function generateSitemap(): void
    {
        $sitemap = Sitemap::create();
        $sitemap->add(Url::create("/")->setLastModificationDate(Page::homePage()->updated_at));

        foreach (Slug::all() as $slug) {
            if ($slug->slug_full === Page::HOME_SLUG) {
                continue;
            }

            $sitemap->add(Url::create($slug->slug_full)->setLastModificationDate($slug->post->updated_at));
        }

        $sitemap->writeToFile("sitemap.xml");
    }
}
