<?php

namespace App\Rules;

use App\Models\Page;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class SlugUnique implements Rule, DataAwareRule
{
    private array $data;
    private mixed $value;
    private ?int  $item_id;

    public function __construct(?int $item_id = null)
    {
        $this->item_id = $item_id;
    }

    public function passes($attribute, $value)
    {
        $this->value = $value;

        //$model = $this->data["model"];

        $item = new Page();
        $item->slug = $this->data["slug"] ?? Str::slug($this->data["title"]);
        $item->parent_id = $this->data["parent_id"];

        $slug_full = Page::generateSlugFull($item, $item->slug);

        if (Page::where([
                ["slug_full", $slug_full],
                ["id", "!=", $this->item_id],
            ])->count() > 0) {
            return false;
        }

        return true;
    }

    public function message()
    {
        return "Поле \"Слаг\" должно быть уникальным ({$this->value})";
    }

    public function setData($data)
    {
        $this->data = $data;
    }
}
