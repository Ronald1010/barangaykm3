<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->increments('resident_id');
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('middle_name', 50)->nullable();
            $table->date('birthdate');
            $table->enum('gender', ['Male', 'Female', 'Others']);
            $table->enum('civil_status', ['Married', 'Single', 'Divorced', 'Widowed']);
            $table->string('occupation', 50)->nullable();
            $table->string('contact_number', 20)->nullable();
            $table->string('email_address', 50)->nullable();
            $table->string('national_id_number', 20)->nullable();
            $table->string('passport_number', 20)->nullable();
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
        Schema::dropIfExists('residents');
    }
};





