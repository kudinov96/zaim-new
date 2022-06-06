<?php

namespace App\Orchid\Screens\Page;

use App\Actions\Page\DeletePage;
use App\Models\Page;
use App\Orchid\Layouts\Page\PageListLayout;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class PageListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            "pages" => Page::query()
                ->filters()
                ->defaultSort("visibility_status", "desc")
                ->orderBy("created_at", "desc")
                ->paginate(),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Страницы';
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
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add'))
                ->icon('plus')
                ->route('platform.pages.create'),
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
            PageListLayout::class,
        ];
    }

    public function delete(Page $page, DeletePage $deletePage): RedirectResponse
    {
        $deletePage->handle($page);

        Toast::success("Страница успешно удалена");

        return redirect()->route("platform.pages");
    }
}
