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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable(); 
            $table->unsignedBigInteger('store_id')->nullable(); 
            $table->text('payment_method')->nullable(); 
            $table->double('price_total')->nullable(); 
            $table->integer('amount_total')->nullable(); 
            $table->text('status_pay')->nullable(); 
            $table->text('status_delivery')->nullable(); 
            $table->text('status_sales')->nullable(); 
            $table->timestamps();

            $table
            ->foreign('customer_id')
            ->references('id')
            ->on('customers')
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
        Schema::dropIfExists('sales');
    }
};
