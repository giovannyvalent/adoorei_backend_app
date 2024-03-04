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
        Schema::create('purchases_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sale_id')->nullable(); 
            $table->unsignedBigInteger('product_id')->nullable(); 
            $table->double('price')->nullable(); 
            $table->integer('amount')->nullable(); 
            $table->timestamps();

            $table
            ->foreign('sale_id')
            ->references('id')
            ->on('sales')
            ->onDelete('cascade');

            $table
            ->foreign('product_id')
            ->references('id')
            ->on('products')
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
        Schema::dropIfExists('purchases_sales');
    }
};
