<?php

namespace App\Enums;

enum PageTemplateEnum: string
{
    case DEFAULT = "default";
    case HOME    = "home";

    public static function getArray(): array
    {
        $array = [];
        foreach (self::cases() as $item) {
            $array[$item->value] = $item->value;
        }

        return $array;
    }
}
