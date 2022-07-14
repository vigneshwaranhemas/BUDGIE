<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidateSeatingAndEmailRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_seating_and_email_requests', function (Blueprint $table) {
            $table->id();
            $table->string('Old_empID');
            $table->string('Off_empId');
            $table->string('Seating_Request');
            $table->string('Email_Request');
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
        Schema::dropIfExists('candidate_seating_and_email_requests');
    }
}
