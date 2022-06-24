<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show(Page $page, Request $request)
    {
        return response()->view("front.page.template.{$page->template->value}", [
            "page" => $page,
        ]);
    }
}
