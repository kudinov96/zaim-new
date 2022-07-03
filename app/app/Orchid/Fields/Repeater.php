<?php

namespace App\Orchid\Fields;

use Illuminate\Support\Facades\Crypt;
use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;

class Repeater extends Field
{
    protected $view = "platform.fields.repeater";

    /**
     * All attributes that are available to the field.
     */
    protected $attributes = [
    ];

    /**
     * Required Attributes.
     */
    protected $required = [
        "name",
        "layout",
    ];

    /**
     * Attributes available for a particular tag.
     */
    protected $inlineAttributes = [
        "name",
    ];

    public function layout(string $layout): self
    {
        if (! class_exists($layout) && ! (app($layout) instanceof Rows)) {
            throw new \InvalidArgumentException(
                __("\":class\" does not exists or not supported. Only rows supported by repeater.", [
                    "class" => $layout,
                ]));
        }

        $this->set("layout", Crypt::encryptString($layout));

        return $this;
    }

    public static function make(string $name = null): Field
    {
        $field = new static();
        $field->name($name);

        return $field;
    }

}
