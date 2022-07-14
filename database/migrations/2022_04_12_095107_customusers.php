<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models;

class Customusers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customusers', function (Blueprint $table) {
            $table->increments('id');
          $table->string('empID');
          $table->string('username');
          $table->string('passcode');
          $table->string('role_type');
          $table->string('gender');
          $table->string('doj');
          $table->string('dob');
          $table->string('department');
          $table->string('designation');
          $table->string('worklocation');
          $table->string('payroll_status');
          $table->string('grade');
          $table->string('email');
          $table->string('contact_no');
          $table->string('sup_emp_code');
          $table->string('sup_name');
          $table->string('reviewer_emp_code');
          $table->string('reviewer_name');
          $table->boolean('active');
          $table->rememberToken();
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
        Schema::dropIfExists('customusers');
    }
}
