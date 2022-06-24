<?php

use App\Enums\PageTemplateEnum;
use App\Models\Page;
use App\Models\Slug;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("page", function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("template")->default(PageTemplateEnum::DEFAULT->value);
            $table->text("content")->nullable();
            $table->boolean("visibility_status")->default(false);
            $table->unsignedBigInteger("parent_id")->nullable();
            $table->timestamps();

            $table->foreign("parent_id")->references("id")->on("page")->onDelete("set null");
        });

        $page = Page::create([
            "id"                => Page::HOME_ID,
            "title"             => "Home page",
            "template"          => PageTemplateEnum::HOME,
            "visibility_status" => true,
        ]);

        Slug::create([
            "slug_full" => Page::HOME_SLUG,
            "model_id"  => $page->id,
            "model"     => Page::class,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page');
    }
};
