<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('booking_id');
            $table->integer('offer_id')->default(0);
            $table->integer('promo_id')->default(0);
            $table->decimal('amount', 8, 2)->default('0.00');
            $table->string('transaction_id',100)->nullable();
            $table->string('payment_gatway',50)->nullable(); 
            $table->string('payment_method',50)->nullable();//card /netbanking/upi/wallet
            $table->tinyInteger('status')->default('0'); 
            $table->bigInteger('batch_id')->default('0');
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
        Schema::dropIfExists('payment_histories');
    }
}
