<?php

namespace App\Orchid\Layouts\Repeaters;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class MenuRepeater extends Rows
{
    protected function fields(): iterable
    {
        return [
            Input::make("text")
                ->placeholder("Текст")
                ->required(),
            Input::make("link")
                ->placeholder("Ссылка")
                ->required(),
        ];
    }
}
