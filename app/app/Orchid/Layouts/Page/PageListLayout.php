<?php

namespace App\Orchid\Layouts\Page;

use App\Models\Page;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PageListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = "pages";

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make("visibility_status", "●")
                ->render(function (Page $page){
                    return $page->visibility_status ? "<i class=\"text-success\">●</i>" : "<i class=\"text-danger\">●</i>";
                })
                ->sort()
                ->cantHide()
                ->alignLeft()
                ->width(80),
            TD::make("title", "Заголовок")
                ->render(function (Page $page){
                    $route = route("platform.pages.edit", ["page" => $page]);
                    return "<a href=\"{$route}\">{$page->title}</a>";
                })
                ->filter(TD::FILTER_TEXT)
                ->cantHide()
                ->alignLeft()
                ->width("500px"),
            TD::make("template", "Шаблон")
                ->alignRight()
                ->width(200),
            TD::make("updated_at", "Обновлено")
                ->render(function (Page $page){
                   return $page->updated_at->format("d.m.Y - H:i:s");
                })
                ->alignRight()
                ->width(200),
            TD::make("created_at", "Создано")
                ->render(function (Page $page){
                    return $page->created_at->format("d.m.Y - H:i:s");
                })
                ->alignRight()
                ->width(200),
            TD::make(__("Actions"))
                ->align(TD::ALIGN_CENTER)
                ->width("100px")
                ->render(function (Page $page) {
                    return DropDown::make()
                        ->icon("options-vertical")
                        ->list([
                            Link::make(__("Edit"))
                                ->route("platform.pages.edit", $page)
                                ->icon("pencil"),

                            Button::make(__("Delete"))
                                ->icon("trash")
                                ->confirm("Данное действие не сможет быть отменено")
                                ->method("delete", [
                                    "page_id" => $page->id,
                                ]),
                        ]);
                }),
        ];
    }
}
