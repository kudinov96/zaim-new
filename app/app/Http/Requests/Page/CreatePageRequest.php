<?php

namespace App\Http\Requests\Page;

use App\Enums\PageTemplateEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

/**
 * @property string           $title
 * @property PageTemplateEnum $template
 * @property string           $content
 * @property bool             $visibility_status
 */
class CreatePageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "title"             => "required|string",
            "template"          => ["required", new Enum(PageTemplateEnum::class)],
            "content"           => "nullable|string",
            "visibility_status" => "required|boolean",
        ];
    }
}
