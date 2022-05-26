<?php

namespace App\Models;

use App\Enums\PageTemplateEnum;
use App\Models\Traits\UniqueSluggable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * @property integer          $id
 * @property string           $title
 * @property string           $slug
 * @property PageTemplateEnum $template
 * @property string           $content
 *
 * @property Carbon           $created_at
 * @property Carbon           $updated_at
 */
class Page extends Model
{
    use HasFactory, UniqueSluggable, SoftDeletes, AsSource, Filterable, Attachable;

    protected $table   = "pages";

    protected $casts   = [
        "template" => PageTemplateEnum::class,
    ];

    protected $guarded = [
        "id",
    ];
}
