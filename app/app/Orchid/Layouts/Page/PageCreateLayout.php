<?php

namespace App\Orchid\Layouts\Page;

use App\Enums\PageTemplateEnum;
use App\Models\Page;
use App\Orchid\Fields\TinyMce;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class PageCreateLayout extends Rows
{
    public ?Page $page;

    public function __construct(?Page $page = null)
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
                ->sendTrueOrFalse()
                ->disabled(!Auth::user()->inRole("admin")),
            Input::make("title")
                ->title("Заголовок")
                ->type("text")
                ->value($page->title ?? "")
                ->required(),
            Input::make("slug")
                ->title("Слаг")
                ->type("text")
                ->value($page->title && $page->slug_single ? $page->slug_single : "")
                ->disabled($page->created_at && $page->canUpdateSlug() || $page->id === Page::HOME_ID),
            Select::make("template")
                ->title("Шаблон")
                ->options(PageTemplateEnum::getArray())
                ->value($page->template->value ?? PageTemplateEnum::DEFAULT->value)
                ->required(),
            Select::make("parent_id")
                ->fromQuery(Page::whereNotIn("id", [$page->id ?? 0, Page::HOME_ID]), "title")
                ->value($page->parent_id)
                ->empty()
                ->title("Родительская страница")
                ->canSee($page->id !== Page::HOME_ID),
            TinyMce::make("content")
                ->title("Content")
                ->value($page->content ?? ""),
        ];
    }
}
