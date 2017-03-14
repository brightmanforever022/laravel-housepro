<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
 	Schema::create('transactions', function (Blueprint $table) {
         $table->increments('id');
         $table->string('payKey');
 	 $table->timestamp('paytime');
	 $table->integer('user_id');
	 $table->string('status');
	 $table->string('transactionId');
	 $table->decimal('amount', 10, 0);
	 $table->string('email');
         $table->integer('booking_id');
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
        //
        Schema::drop('transactions');
    }
}
