<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceivePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receive_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id');
            $table->string('received_by');
            $table->integer('client_id');
            $table->bigInteger('paid_amount');
            $table->bigInteger('due');
            $table->text('note')->nullable();
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
        Schema::dropIfExists('receive_payments');
    }
}
