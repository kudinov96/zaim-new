<?php

declare(strict_types=1);

use App\Http\Controllers\Platform\Fields\RepeaterController;
use App\Orchid\Screens\Page\PageCreateScreen;
use App\Orchid\Screens\Page\PageEditScreen;
use App\Orchid\Screens\Page\PageListScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\OptionsScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

Route::screen("/main", PlatformScreen::class)
    ->name("platform.main");

Route::screen("profile", UserProfileScreen::class)
    ->name("platform.profile")
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent("platform.index")
            ->push(__("Profile"), route("platform.profile"));
    });

// Fields
Route::post("repeater/fetch-blocks", [RepeaterController::class, "fetchBlocks"])
    ->name("platform.fields.repeater.fetch_blocks");
Route::post("repeater/add-block", [RepeaterController::class, "addBlock"])
    ->name("platform.fields.repeater.add_block");

// Users
Route::screen("users/{user}/edit", UserEditScreen::class)
    ->name("platform.systems.users.edit")
    ->breadcrumbs(function (Trail $trail, $user) {
        return $trail
            ->parent("platform.systems.users")
            ->push(__("User"), route("platform.systems.users.edit", $user));
    });

Route::screen("users/create", UserEditScreen::class)
    ->name("platform.systems.users.create")
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent("platform.systems.users")
            ->push(__("Create"), route("platform.systems.users.create"));
    });

Route::screen("users", UserListScreen::class)
    ->name("platform.systems.users")
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent("platform.index")
            ->push(__("Users"), route("platform.systems.users"));
    });

// Roles
Route::screen("roles/{role}/edit", RoleEditScreen::class)
    ->name("platform.systems.roles.edit")
    ->breadcrumbs(function (Trail $trail, $role) {
        return $trail
            ->parent("platform.systems.roles")
            ->push(__("Role"), route("platform.systems.roles.edit", $role));
    });

Route::screen("roles/create", RoleEditScreen::class)
    ->name("platform.systems.roles.create")
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent("platform.systems.roles")
            ->push(__("Create"), route("platform.systems.roles.create"));
    });

Route::screen("roles", RoleListScreen::class)
    ->name("platform.systems.roles")
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent("platform.index")
            ->push(__("Roles"), route("platform.systems.roles"));
    });

// Settings
Route::screen("settings", OptionsScreen::class)
    ->name("platform.options")
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent("platform.index")
            ->push(__("Настройки"), route("platform.options"));
    });

// Pages
Route::screen("pages", PageListScreen::class)
    ->name("platform.pages")
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent("platform.index")
            ->push(__("Страницы"), route("platform.pages"));
    });

Route::screen("pages/create", PageCreateScreen::class)
    ->name("platform.pages.create")
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent("platform.pages")
            ->push(__("Create"), route("platform.pages.create"));
    });

Route::screen("pages/{page}/edit", PageEditScreen::class)
    ->name("platform.pages.edit")
    ->breadcrumbs(function (Trail $trail, $page) {
        return $trail
            ->parent("platform.pages")
            ->push(__("Edit"), route("platform.pages.edit", $page));
    });
