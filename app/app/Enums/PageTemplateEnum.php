<?php

namespace App\Enums;

enum PageTemplateEnum: string
{
    use BaseEnum;

    case DEFAULT = "default";
    case HOME    = "home";
}
