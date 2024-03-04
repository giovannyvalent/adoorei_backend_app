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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('store_id')->nullable();
            $table->text('name')->nullable();
            $table->double('price')->nullable();
            $table->timestamps();

            $table
            ->foreign('category_id')
            ->references('id')
            ->on('category')
            ->onDelete('cascade');

            $table
            ->foreign('store_id')
            ->references('id')
            ->on('stores')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
