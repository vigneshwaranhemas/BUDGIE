<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('event_name');
            $table->string('label_color');
            $table->string('where');
            $table->string('event_file');
            $table->mediumText('description');
            $table->dateTime('start_date_time');
            $table->dateTime('end_date_time');
            $table->date('date');
            $table->enum('repeat', ['yes', 'no'])->default('no');
            $table->integer('repeat_every')->nullable();
            $table->integer('repeat_cycles')->nullable();
            $table->enum('repeat_type', ['day', 'week', 'month', 'year'])->default('day');
            $table->string('category_name');
            $table->string('event_type');
            $table->string('code');
            $table->text('candicate_list');
            $table->string('attendees_filter_op');
            $table->string('attendees_filter');
            $table->string('all_filter_attendees');
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
        Schema::dropIfExists('events');
    }
}
