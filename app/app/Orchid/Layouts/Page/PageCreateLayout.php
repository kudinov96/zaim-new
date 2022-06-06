<?php

namespace App\Orchid\Layouts\Page;

use App\Enums\PageTemplateEnum;
use App\Models\Page;
use App\Orchid\Fields\TinyMce;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class PageCreateLayout extends Rows
{
    public Page $page;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    protected function fields(): iterable
    {
        $page = $this->page;

        return [
            CheckBox::make("visibility_status")
                ->title("Опубликовано")
                ->value($page->visibility_status ?? false)
                ->sendTrueOrFalse(),
            Input::make("title")
                ->title("Заголовок")
                ->type("text")
                ->value($page->title ?? "")
                ->required(),
            Select::make("template")
                ->title("Шаблон")
                ->options(PageTemplateEnum::getArray())
                ->value($page->template->value ?? PageTemplateEnum::DEFAULT->value)
                ->required(),
            TinyMce::make("content")
                ->title("Content")
                ->value($page->content ?? ""),
        ];
    }
}
