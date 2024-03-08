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
        Schema::create('certificates', function (Blueprint $table) {
            $table->increments('certificate_id');
            $table->string('name', 50);
            $table->integer('age');
            $table->string('address', 100);
            $table->string('contact_number')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Others']);
            $table->string('purpose');
            $table->string('certificate_type', 50);
            $table->date('request_date');
            $table->date('issued_date')->nullable();
            $table->enum('status', ['Pending', 'Approved', 'Denied']);
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
        Schema::dropIfExists('certificates');
    }
};
