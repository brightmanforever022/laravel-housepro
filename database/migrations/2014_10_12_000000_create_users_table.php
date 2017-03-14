<?php

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
            $table->increments('id');
            $table->string('company');
            $table->enum('saluation', array('Mr', 'Mrs', 'Ms'))->index();
            $table->string('name');
            $table->string('surname');
            $table->bigInteger('phone');
            $table->string('email')->unique();
            $table->string('address');
            $table->string('additional_address');
            $table->string('place');
            $table->string('city')->nullable();
            $table->integer('zipcode')->nullable();
            $table->string('country_id');
            $table->string('password');
            $table->integer('user_type')->comment = "1 = host, 0 = user, 2=admin";
            $table->boolean('is_verified')->default(0)->comment = "0 = no, 1 = yes";
            $table->boolean('is_admin')->default(0)->comment = "0 = no, 1 = yes";
            $table->boolean('active')->default(0)->comment = "0 = no, 1 = yes";
            $table->string('path');
            $table->string('paypal_email');
            $table->rememberToken();
            $table->string('hash_key');
            $table->timestamp('updated_at')->nullableTimestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
