<?php

use App\Http\Controllers\RobotsController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\SlugController;
use App\Models\Page;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/" . Page::HOME_SLUG, function () {
    abort(404);
});

Route::get("robots.txt", [RobotsController::class, "index"]);
Route::get("sitemap.xml", [SitemapController::class, "index"]);

Route::get("{slug?}", [SlugController::class, "find"])->where("slug", ".*")->name("slug");
