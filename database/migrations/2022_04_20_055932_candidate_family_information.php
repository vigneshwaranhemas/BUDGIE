<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CandidateFamilyInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_family_information', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id')->nullable();
            $table->string('cdID')->nullable();
            $table->string('fm_name')->nullable();
            $table->string('fm_gender')->nullable();
            $table->string('fn_relationship')->nullable();
            $table->string('fn_marital')->nullable();
            $table->string('fn_blood_gr')->nullable();
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
