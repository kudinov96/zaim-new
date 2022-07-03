<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OptionsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "options"             => "nullable|array",
            "options.menu"        => "nullable|array",
            "options.menu.*.text" => "required|string",
            "options.menu.*.link" => "required|string",
        ];
    }
}
