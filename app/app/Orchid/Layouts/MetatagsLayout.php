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
            Input::make("metas.meta_title")
                ->title("Title")
                ->type("text")
                ->value($model && $model->getMeta("meta_title") ? $model->getMeta("meta_title") : "")
                ->required(),
            TextArea::make("metas.meta_description")
                ->title("Description")
                ->value($model && $model->getMeta("meta_description") ? $model->getMeta("meta_description") : "")
                ->required(),
            TextArea::make("metas.meta_keywords")
                ->value($model && $model->getMeta("meta_keywords") ? $model->getMeta("meta_keywords") : "")
                ->title("Keywords"),
        ];
    }
}
