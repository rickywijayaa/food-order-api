<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->longText("description");
            $table->integer("price");
            $table->string("image");
            $table->unsignedBigInteger("categories_id");
            $table->boolean("isAvailable")->default(1);
            $table->timestamps();

            $table->foreign("categories_id")
                ->references("id")->on("categories");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
