<?php

namespace App\Http\Controllers\Platform\Fields;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Crypt;
use ReflectionMethod;

class RepeaterController extends Controller
{
    public function fetchBlocks(Request $request): string
    {
        $data = "";

        if ($request->value) {
            foreach (json_decode($request->value, true) as $key => $value) {
                $data .= $this->renderFields($request, $key, $value);
            }
        }

        return $data;
    }

    public function addBlock(Request $request): string
    {
        return $this->renderFields($request, $request->count);
    }

    private function renderFields(Request $request, int $count, ?array $value = null): string
    {
        $layout        = Crypt::decryptString($request->layout);
        $layout        = new $layout();
        $layout_fields = (new ReflectionMethod($layout, "fields"))->invoke($layout);

        $data = '<div class="repeater__blocks-item mb-4 border border-start border-1 p-3">';

        foreach ($layout_fields as $field) {
            $name = $field->getOldName();

            $field->name($request->name . "[$count]" . "[" . $name . "]");
            $field->value($value[$name] ?? null);

            $data .= $field->render();
        }

        $data .= Blade::render(
            '<button class="btn btn-danger" type="button" data-action="click->repeater#removeBlock">
                <x-orchid-icon path="minus" />
             </button>');

        $data .= '</div>';

        return $data;
    }
}
