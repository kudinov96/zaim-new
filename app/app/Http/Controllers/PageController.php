<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller
{
    public function show(Page $page)
    {
        return response()->view("front.page.template.{$page->template->value}", [
            "page"  => $page,
            "metas" => $page->getAllMeta(),
        ]);
    }
}
