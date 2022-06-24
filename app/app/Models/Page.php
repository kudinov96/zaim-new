<?php

namespace App\Models;

use App\Enums\PageTemplateEnum;
use App\Models\Traits\SlugFull;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use Plank\Metable\Metable;

/**
 * @property int              $id
 * @property string           $title
 * @property PageTemplateEnum $template
 * @property bool             $visibility_status
 * @property string           $content
 * @property int              $parent_id
 *
 * @property Carbon           $created_at
 * @property Carbon           $updated_at
 */
class Page extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;
    use Attachable;
    use SlugFull;
    use Metable;

    const HOME_ID   = 1;
    const HOME_SLUG = "home";

    protected $table = "page";

    protected $guarded = [
        "id",
    ];

    protected $casts = [
        "template" => PageTemplateEnum::class,
    ];

    protected array $allowedSorts = [
        "visibility_status",
    ];

    protected array $allowedFilters = [
        "title",
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, "parent_id");
    }

    public function pages(): HasMany
    {
        return $this->hasMany(self::class, "parent_id");
    }

    public function childrenPages(): HasMany
    {
        return $this->pages()->with("pages");
    }

    public function scopeIsPublished(Builder $query)
    {
        return $query->where([
            ["id", $this->id],
            ["visibility_status", true],
        ])->exists();
    }

    public static function homePage()
    {
        return self::find(self::HOME_ID);
    }
}
