<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('products')){
            Schema::create('products', function (Blueprint $table) {
                $table->id()->unsigned();
                $table->string('img')->default("product-dummy.png");
                $table->string('name');
                $table->integer('units');
                $table->double('price');
                $table->string('description');
                $table->bigInteger('category_id')->unsigned();
                $table->engine = 'InnoDB';
            });

            Schema::table('products', function (Blueprint $table){
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
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
        Schema::dropIfExists('products');
    }
}
