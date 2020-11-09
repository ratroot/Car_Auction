<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_pic')->nullable();
            $table->string('EIDnumber')->nullable();
            $table->string('DOB')->nullable();
            $table->string('phone')->nullable();
            $table->string('EID_front_pic')->nullable();
            $table->string('EID_back_pic')->nullable();
            $table->integer('approved')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
