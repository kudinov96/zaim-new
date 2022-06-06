<?php

declare(strict_types=1);

namespace App\Orchid\Fields;

use Orchid\Screen\Field;

class TinyMce extends Field
{
    protected $view = "platform.fields.tinymce";

    /**
     * All attributes that are available to the field.
     *
     * @var array
     */
    protected $attributes = [
        'value'  => null,
        'height' => '300px',
    ];

    /**
     * Attributes available for a particular tag.
     *
     * @var array
     */
    protected $inlineAttributes = [
        'accept',
        'accesskey',
        'autocomplete',
        'autofocus',
        'checked',
        'disabled',
        'form',
        'formaction',
        'formenctype',
        'formmethod',
        'formnovalidate',
        'formtarget',
        'list',
        'max',
        'maxlength',
        'min',
        'name',
        'pattern',
        'placeholder',
        'readonly',
        'required',
        'size',
        'src',
        'step',
        'tabindex',
        'type',
        'value',
        'height',
    ];

    /**
     * @param string|null $name
     *
     * @return self
     */
    public static function make(string $name = null):Field
    {
        $editor = new static();
        $editor->language($editor->get('language') ?? app()->getLocale());
        $editor->name($name);

        return $editor;
    }
}
