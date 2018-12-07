<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id');
            $table->integer('client_id')->nullable();
            $table->integer('items');
            $table->bigInteger('subTotal');
            $table->bigInteger('additionalCost');
            $table->bigInteger('discount');
            $table->bigInteger('totalBill');
            $table->bigInteger('paidAmount');
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
        Schema::dropIfExists('sales');
    }
}
