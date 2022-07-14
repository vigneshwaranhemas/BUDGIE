<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_masters', function (Blueprint $table) {
            $table->id();
            $table->string('empID');
            $table->string('lop_granted');
            $table->string('lop_balance');
            $table->string('lop_type');
            $table->string('on_duty_granted');
            $table->string('on_duty_balance');
            $table->string('on_duty_type');
            $table->string('prob_granted');
            $table->string('prob_balance');
            $table->string('prob_type');
            $table->string('wfh_granted');
            $table->string('wfh_balance');
            $table->string('wfh_type');
            $table->string('privilege_granted');
            $table->string('privilege_balance');
            $table->string('privilege_type');
            $table->string('sick_granted');
            $table->string('sick_balance');
            $table->string('sick_type');
            $table->string('casual_granted');
            $table->string('casual_balance');
            $table->string('casual_type');
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
        Schema::dropIfExists('leave_masters');
    }
}
