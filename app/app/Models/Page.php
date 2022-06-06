<?php

namespace App\Models;

use App\Enums\PageTemplateEnum;
use App\Models\Traits\UniqueSluggable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * @property integer              $id
 * @property string               $title
 * @property string               $slug
 * @property PageTemplateEnum     $template
 * @property bool                 $visibility_status
 * @property string               $content
 * @property int                  $parent_id
 *
 * @property Carbon               $created_at
 * @property Carbon               $updated_at
 */
class Page extends Model
{
    use HasFactory;
    use UniqueSluggable;
    use AsSource;
    use Filterable;
    use Attachable;

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

    public function pages(): HasMany
    {
        return $this->hasMany(Page::class, "parent_id");
    }

    public function childrenPages(): HasMany
    {
        return $this->pages()->with("pages");
    }
}
