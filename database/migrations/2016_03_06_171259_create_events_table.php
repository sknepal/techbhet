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
            $table->string('title');
            $table->string('description');
            $table->string('location');
            $table->string('main_image');
            $table->date('date');
            $table->time('time');
            $table->integer('owner_id');
            $table->timestamps();

            $table->string('meetup');
            $table->string('fb');
            $table->string('organizer');
            $table->string('details_organizer');
            $table->string('tags');

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
