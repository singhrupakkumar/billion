<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('parent_id');
            $table->string('name',100); 
            $table->text('description');
            $table->text('how_it_work');
            $table->binary('icon')->nullable();
            $table->binary('image')->nullable();
            $table->string('service_city',1000); // service provide city
            $table->decimal('visiting_charge', 8, 2)->nullable();
            $table->decimal('pickup_charge', 8, 2)->nullable(); 
            $table->tinyInteger('status')->default('0'); // inactive 1 , active 0
            $table->tinyInteger('is_deleted')->default('0'); // default 0 , delete  1
            $table->tinyInteger('isHotDeals')->default('0'); // default 0 , active  1
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
        Schema::dropIfExists('categories');
    }
}
