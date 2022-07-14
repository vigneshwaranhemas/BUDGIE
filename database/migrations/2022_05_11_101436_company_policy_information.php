<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CompanyPolicyInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_policy_information', function (Blueprint $table) {
            $table->id();
            $table->string('cp_id');
            $table->string('policy_category');
            $table->string('policy_title');
            $table->string('policy_description');
            $table->string('file_upload');
            $table->string('status');
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
        //
    }
}
