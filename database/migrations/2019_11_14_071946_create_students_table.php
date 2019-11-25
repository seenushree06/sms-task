<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('name');
            $table->string('standard');
            $table->enum('gender', [1,2])->default(1);
            $table->string('religion')->nullable();
            $table->string('blood_group',10)->nullable();
            $table->string('nationality',50)->nullable();
            $table->string('photo')->nullable();
            $table->string('email',100)->nullable();
            $table->string('phone_no')->nullable();
            $table->enum('status', [0,1])->default(1);

            $table->timestamps();
            $table->softDeletes();
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
