<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
 	Schema::create('payments', function (Blueprint $table) {
         $table->increments('id');
         $table->integer('user_id');
 	 $table->integer('host_id');
	 $table->integer('billing_id');
	 $table->text('token');
         $table->string('status');
	 $table->decimal('amount', 10, 0);
	 $table->decimal('initial', 10, 2);
         $table->enum('refund_status', [0, 1, 2])->default(0);         
         $table->string('booking_pdf');
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
        Schema::drop('payments');
    }
}
