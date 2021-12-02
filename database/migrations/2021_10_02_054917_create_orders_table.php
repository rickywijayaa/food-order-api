<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string("status");
            $table->unsignedBigInteger("users_id");
            $table->unsignedBigInteger("menus_id");
            $table->integer("totalPrice");
            $table->string("notes");
            $table->string("order_in_date");

            $table->foreign("users_id")
            ->references("id")->on("users");

            $table->foreign("menus_id")
            ->references("id")->on("menus");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
