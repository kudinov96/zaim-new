<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Slug;
use Illuminate\Http\Request;

class SlugController extends Controller
{
    public function find(Request $request, ?string $slug = null)
    {
        $page = $this->getPage($slug);

        if (!$page->isPublished()) {
            abort(404);
        }

        $controller = "App\Http\Controllers\\" . $page->getClassName() . "Controller";

        return (new $controller())->show($page, $request);
    }

    private function getPage(?string $slug = null)
    {
        if (!$slug) {
            return Page::homePage();
        }

        $slug = Slug::findBySlugOrFail($slug);

        return $slug->page($slug->model)->first();
    }
}
