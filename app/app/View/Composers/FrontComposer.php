<?php

namespace App\View\Composers;

use Illuminate\Support\Facades\Request;
use Illuminate\View\View;

class FrontComposer
{
    public function compose(View $view): void
    {
        $view->with("site_path", Request::path());
        $view->with("options", getOptions());
    }
}
