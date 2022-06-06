<?php

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
        Schema::create('page', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string('slug')->unique();
            $table->string("template")->default("default");
            $table->text("content")->nullable();
            $table->boolean("visibility_status")->default(true);
            $table->unsignedBigInteger("parent_id")->nullable();
            $table->timestamps();

            $table->foreign("parent_id")->references("id")->on("page")->onDelete("set null");
        });
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
