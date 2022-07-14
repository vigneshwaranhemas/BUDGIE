<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CandidateContactInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('candidate_contact_information', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id')->nullable();
            $table->string('cdID')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('s_number')->nullable();
            $table->string('p_adderss')->nullable();
            $table->string('c_address')->nullable();
            $table->string('p_email')->nullable();
            $table->string('State')->nullable();
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
