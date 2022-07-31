<?php

namespace App\Http\Controllers;

use App\Models\Page;

class SitemapController extends Controller
{
    public function index()
    {
        $home_page = Page::query()->find(Page::HOME_ID);
        $pages     = Page::query()
            ->published()
            ->where("id", "!=", Page::HOME_ID)
            ->get();

        return response()->view("sitemap", [
            "home_page" => $home_page,
            "pages"     => $pages,
        ])->header("Content-Type", "text/xml");
    }
}
