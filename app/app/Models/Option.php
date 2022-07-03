<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Plank\Metable\Meta;

class Option
{
    const OPTION_ID = 0;

    public static function getAllOptions(): Collection
    {
        $options = Meta::query()->where([
            ["metable_type", Option::class],
            ["metable_id", Option::OPTION_ID],
        ])->get();

        return $options->toBase()->map(function (Meta $meta) {
            return [
                $meta->key => $meta->value,
            ];
        })->collapse();
    }

    public static function getOption(string $key)
    {
        return Meta::query()->where([
            ["metable_type", Option::class],
            ["metable_id", Option::OPTION_ID],
            ["key", $key],
        ])->first();
    }

    public static function deleteAllOptions(): void
    {
        Meta::query()->where([
            ["metable_type", Option::class],
            ["metable_id", Option::OPTION_ID],
        ])->delete();
    }
}
