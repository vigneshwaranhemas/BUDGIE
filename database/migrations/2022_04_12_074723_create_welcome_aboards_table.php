<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWelcomeAboardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('welcome_aboards', function (Blueprint $table) {
            $table->id();
            $table->string('wa_id');
            $table->string('name');
            $table->string('designation');
            $table->string('department');
            $table->string('today_date');
            $table->string('education_my');
            $table->string('education_from');
            $table->string('education_in');
            $table->string('achievements_education');
            $table->string('work_in');
            $table->string('work_designation');
            $table->string('work_years');
            $table->string('work_experience_at');
            $table->string('work_experience_as');
            $table->string('work_experience_years');
            $table->string('joining_at');
            $table->string('joining_as');
            $table->string('achievements_work');
            $table->string('my_favorite_pastime');
            $table->string('my_favorite_hobbies');
            $table->string('my_favorite_places');
            $table->string('my_favorite_foods');
            $table->string('my_favorite_sports');
            $table->string('my_favorite_movies');
            $table->string('my_favorite');
            $table->string('my_extracurricular_specialities');
            $table->string('my_career_aspirations');
            $table->string('languages');
            $table->string('interesting_facts');
            $table->string('my_motto');
            $table->string('books');
            $table->string('created_on');
            $table->string('created_by');
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
        Schema::dropIfExists('welcome_aboards');
    }
}
