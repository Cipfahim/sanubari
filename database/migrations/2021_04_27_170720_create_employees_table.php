<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')-references('id')->on('users');
            $table->enum('gender', ['M', 'F']);
            $table->string('official_name',30);
            $table->string('nick_name',30)->nullable();
            $table->date('date_of_join');
            $table->date('date_of_birth');
            $table->enum('citizenship', ['L', 'F']);
            $table->string('ic_number', 100)->nullable();
            $table->string('passport_number', 100)->nullable();
            $table->string('country_of_birth', 20)->nullable();
            $table->string('state_of_birth', 20)->nullable();
            $table->tinyInteger('leave_quota');
            $table->foreignId('bank_id')-references('id')->on('banks');
            $table->string('accounts',25)->nullable();
            $table->string('avatar')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('employees');
    }
}
