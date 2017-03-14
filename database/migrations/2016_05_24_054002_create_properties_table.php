<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('plz_place');
            $table->string('street');
            $table->double('lat', 10, 6);
            $table->double('lng', 10, 6);
            $table->integer('country_id');
            $table->integer('bedroom');
            $table->integer('bathroom');
            $table->integer('bed');
            $table->integer('apartment_for');
            $table->string('lining_space');
            $table->integer('property_type_id');
            $table->double('price_per_night', 10, 2);
            $table->double('price_per_week', 10, 2);
            $table->double('cleaning_fee', 10, 2);
            $table->integer('min_stay');
            $table->integer('cancel_day');
            $table->double('cancel_fee', 10, 2);
            $table->string('vat_number');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('title');
            $table->text('description');
            $table->enum('property_booking_status', [0, 1, 2])->default(0);           
            $table->integer('booking_id');
            $table->integer('user_id');
            $table->boolean('active')->default(0)->comment = "0 = no, 1 = yes";
            $table->text('icon_path');
            $table->decimal('price_per_night', 5, 2);
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
        Schema::drop('properties');
    }
}
