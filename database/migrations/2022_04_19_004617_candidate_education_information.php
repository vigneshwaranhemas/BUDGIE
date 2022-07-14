<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CandidateEducationInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_education_information', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id')->nullable();
            $table->string('cdID')->nullable();
            $table->string('qualification')->nullable();
            $table->string('institute')->nullable();
            $table->string('begin_on')->nullable();
            $table->string('end_on')->nullable();
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
    }
}
