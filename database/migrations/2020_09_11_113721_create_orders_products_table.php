<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('orders_products')){
            Schema::create('orders_products', function (Blueprint $table) {
                $table->id();
                $table->integer('quantity');
                $table->bigInteger('products_id')->unsigned();
                $table->bigInteger('orders_id')->unsigned();
                $table->engine = 'InnoDB';
            });

            Schema::table('orders', function (Blueprint $table){
                $table->foreign('products_id')->references('id')->on('products');
                $table->foreign('orders_id')->references('id')->on('orders');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_products');
    }
}
