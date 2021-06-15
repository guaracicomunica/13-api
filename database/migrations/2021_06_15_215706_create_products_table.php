<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->string('title');
            $table->text('description');
            $table->float('price');
            $table->integer('inventory_quantity');
            $table->timestamps();

            $table->unsignedBigInteger('product_type_id');
            $table->unsignedBigInteger('product_size_id');

            $table->foreign('product_type_id')->references('id')->on('product_types');
            $table->foreign('product_size_id')->references('id')->on('product_sizes');
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
}
