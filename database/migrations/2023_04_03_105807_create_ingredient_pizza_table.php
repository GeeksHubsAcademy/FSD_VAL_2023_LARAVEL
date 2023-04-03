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
        Schema::create('ingredient_pizza', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pizza_id');
            $table->foreign('pizza_id')
                ->references('id')
                ->on('pizzas')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger('ingredient_id');
            $table->foreign('ingredient_id')->references('id')->on('ingredients')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredient_pizza');
    }
};
