<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('billinginfos', function (Blueprint $table) {
         $table->increments('id');
         $table->date('check_in');
         $table->date('check_out');
         $table->integer('guests');
	 $table->integer('nights');
         $table->string('name');
         $table->enum('saluation', array('Mr', 'Mrs', 'Ms'))->index();
         $table->string('surname'); 
         $table->bigInteger('phone');
         $table->string('email');
	 $table->text('remark');  
	 $table->integer('booking_id'); 
         $table->enum('booking_status_tenant', [0, 1, 2])->default(0);
         $table->enum('booking_status_host', [0, 1, 2])->default(0); 
         $table->timestamp('created_at');
      	 $table->timestamp('updated_at')->nullableTimestamps();   


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
        Schema::drop('billinginfos');
    }
}
