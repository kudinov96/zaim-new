<?php

namespace App\Orchid\Screens;

use App\Actions\Option\CreateOrUpdateOptions;
use App\Http\Requests\OptionsRequest;
use App\Orchid\Fields\Repeater;
use App\Orchid\Layouts\OptionsLayout;
use App\Orchid\Layouts\Repeaters\MenuRepeater;
use Illuminate\Support\Collection;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class OptionsScreen extends Screen
{
    public Collection $options;

    public function query(): iterable
    {
        return [
            "options" => getOptions(),
        ];
    }

    public function name(): ?string
    {
        return "Настройки";
    }

    public function permission(): ?iterable
    {
        return [
            "platform.options",
        ];
    }


    public function commandBar(): iterable
    {
        return [
            Button::make('Сохранить')
                ->method('update')
                ->class("btn btn-primary"),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::tabs([
                "Меню" =>
                    Layout::rows([
                        Repeater::make("options.menu")
                            ->layout(MenuRepeater::class)
                            ->value($this->options["menu"] ?? null)
                            ->title("Меню"),
                    ]),
            ]),
        ];
    }

    public function update(OptionsRequest $request, CreateOrUpdateOptions $createOrUpdateOptions)
    {
        $createOrUpdateOptions->handle($request->options);

        Toast::success("Настройки успешно обновлены");

        return redirect()->route("platform.options");
    }
}
