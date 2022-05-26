<?php

namespace App\Models;

use App\Models\Traits\UniqueSluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string  $title
 * @property string  $slug
 * @property string  $content
 */
class Post extends Model
{
    use HasFactory;
    use UniqueSluggable;

    protected $table   = "posts";

    protected $guarded = [
        "id",
    ];
}
