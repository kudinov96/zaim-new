<?php

namespace App\Orchid\Screens\Page;

use App\Actions\Page\CreatePage;
use App\Http\Requests\Page\CreatePageRequest;
use App\Orchid\Layouts\MetatagsLayout;
use App\Orchid\Layouts\Page\PageCreateLayout;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class PageCreateScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return "Создать страницу";
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
            Button::make('Создать')
                ->method('create')
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
                "Метатеги" => new MetatagsLayout(),
            ]),
            PageCreateLayout::class,
        ];
    }


    public function create(CreatePageRequest $request, CreatePage $createPage): RedirectResponse
    {
        $item = $createPage->handle($request);

        Toast::success("Страница успешно создана");

        return redirect()->route("platform.pages.edit", ["page" => $item->id]);
    }
}

