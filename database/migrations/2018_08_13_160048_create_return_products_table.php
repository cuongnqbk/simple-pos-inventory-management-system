<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id');
            $table->integer('client_id')->nullable();
            $table->integer('returned_item');
            $table->bigInteger('returned_total_bill');
            $table->integer('sale_item')->nullable();
            $table->bigInteger('sale_total_bill')->nullable();
            $table->bigInteger('profit');
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
        Schema::dropIfExists('return_products');
    }
}
