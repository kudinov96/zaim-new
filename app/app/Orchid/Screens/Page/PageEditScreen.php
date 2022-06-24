<?php

namespace App\Orchid\Screens\Page;

use App\Actions\Page\DeletePage;
use App\Actions\Page\UpdatePage;
use App\Http\Requests\Page\UpdatePageRequest;
use App\Models\Page;
use App\Orchid\Layouts\Page\PageCreateLayout;
use App\Orchid\Layouts\MetatagsLayout;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class PageEditScreen extends Screen
{
    public Page $page;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Page $page): iterable
    {
        return [
            "page" => $page,
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return "Редактировать страницу";
    }

    /**
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'platform.pages',
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make("Перейти")
                ->icon("arrow-right-circle")
                ->target("blank")
                ->route("slug", ["slug" => $this->page->slug_full]),
            Button::make("Удалить")
                ->method("delete")
                ->icon("trash")
                ->confirm("Данное действие не сможет быть отменено")
                ->canSee($this->page->id !== Page::HOME_ID),

            Button::make('Сохранить')
                ->method('update')
                ->class("btn btn-primary"),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::accordion([
                "Метатеги" => new MetatagsLayout($this->page),
            ]),
            new PageCreateLayout($this->page),
        ];
    }

    public function update(Page $page, UpdatePageRequest $request, UpdatePage $updatePage): RedirectResponse
    {
        $item = $updatePage->handle($page, $request);

        Toast::success("Страница успешно сохранена");

        return redirect()->route("platform.pages.edit", ["page" => $item->id]);
    }

    public function delete(Page $page, DeletePage $deletePage): RedirectResponse
    {
        $deletePage->handle($page);

        Toast::success("Страница успешно удалена");

        return redirect()->route("platform.pages");
    }
}

