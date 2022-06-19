<?php

namespace App\Http\Requests\Page;

use App\Enums\PageTemplateEnum;
use App\Models\Page;
use App\Models\Slug;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

/**
 * @property string           $title
 * @property string           $slug_full
 * @property PageTemplateEnum $template
 * @property string           $content
 * @property int              $parent_id
 * @property bool             $visibility_status
 */
class UpdatePageRequest extends FormRequest
{
    public function authorize()
    {
        $this->page = $this->route("page");

        return true;
    }

    public function rules()
    {
        return [
            "title"             => "required|string",
            "slug_full"         => ["required", Rule::unique(Slug::class)->ignore($this->page->slug->id)],
            "template"          => ["required", new Enum(PageTemplateEnum::class)],
            "content"           => "nullable|string",
            "parent_id"         => "nullable|exists:page,id",
            "visibility_status" => "required|boolean",
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            "slug_full" => Page::generateSlugFull($this->slug ?? $this->title, $this->parent_id),
        ]);
        $this->offsetUnset("slug");
    }
}
