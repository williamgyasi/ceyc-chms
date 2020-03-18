<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('fellowship_id');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->string('lastname');
            $table->string('firstname');
            $table->string('othernames')->nullable();
            $table->string('phone');
            $table->string('alt_phone')->nullable();
            $table->string('email');
            $table->date('dob');
            $table->text('residential_address');
            $table->string('digital_address')->nullable();
            $table->string('school')->nullable();
            $table->string('work')->nullable();
            $table->string('gender');
            $table->foreign('fellowship_id')->references('id')->on('fellowships');
            $table->foreign('department_id')->references('id')->on('departments');
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
        Schema::dropIfExists('members');
    }
}
