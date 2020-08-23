<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->string('location',255)->nullable(); 
            $table->string('house_no',255)->nullable(); 
            $table->string('title',50)->nullable();
            $table->string('type',50)->nullable(); //Home, Office, Others 
            $table->string('lat',255)->nullable(); 
            $table->string('lng',255)->nullable();
            $table->string('city',100)->nullable();
            $table->string('state',100)->nullable();
            $table->string('pin_code',10)->nullable();   
            $table->tinyInteger('status')->default('0'); // inactive 1 , active 0
            $table->tinyInteger('is_deleted')->default('0'); // default 0 , delete  1
            $table->bigInteger('modified_by')->default('0'); // default 0 , modify user id 
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
        Schema::dropIfExists('addresses');
    }
}
