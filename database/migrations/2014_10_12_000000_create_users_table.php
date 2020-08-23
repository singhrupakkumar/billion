<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',100)->nullable();
            $table->string('email',100)->nullable(); 
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone',15)->unique(); 
            $table->text('about_me')->nullable();
            $table->binary('profile_picture')->nullable();
            $table->date('dob')->nullable();
            $table->string('parent_name',100)->nullable();
            $table->string('gender',50)->nullable();
            $table->string('country')->nullable();
            $table->tinyInteger('status')->default('0'); // inactive 0 , active user 1
            $table->tinyInteger('is_deleted')->default('0'); // default 0 , delete user 1
            $table->bigInteger('modified_by')->default('0'); // default 0 , modify user id
            $table->bigInteger('batch_id')->default('0'); 
            $table->rememberToken()->nullable();
            $table->string('otp',4)->nullable(); 
            $table->string('api_token', 80)->unique()->nullable()->default(null);
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
        Schema::dropIfExists('users');
    }
}
