<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnSaleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_sale_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('return_id');
            $table->integer('shop_id');
            $table->integer('client_id')->nullable();
            $table->integer('product_id');
            $table->integer('quantity');
            $table->bigInteger('price');
            $table->bigInteger('subTotal');
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
        Schema::dropIfExists('return_sale_details');
    }
}
