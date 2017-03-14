<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
         $table->increments('id');
         $table->integer('event_id');
         $table->dateTime('start_date');
         $table->text('rec_type');
         $table->dateTime('end_date');
         $table->text('title');
         $table->integer('event_pid');
         $table->bigInteger('event_length');
         $table->integer('property_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('events');
    }
}
