<?php

namespace App\Orchid\Layouts;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class MetatagsLayout extends Rows
{
    public ?Model $model;

    public function __construct(?Model $model = null)
    {
        $this->model = $model;
    }

    protected function fields(): iterable
    {
        $model = $this->model;

        return [
            Input::make("meta.meta_title")
                ->title("Title")
                ->type("text")
                ->value($model->getMeta("meta_title") ?? "")
                ->required(),
            TextArea::make("meta.meta_description")
                ->title("Description")
                ->value($model->getMeta("meta_description") ?? "")
                ->required(),
            TextArea::make("meta.meta_keywords")
                ->value($model->getMeta("meta_keywords") ?? "")
                ->title("Keywords"),
        ];
    }
}
