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
            $table->id()->from(200);
            $table->string('employee_number')->unique()->nullable();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->string('official_name', 50);
            $table->string('nick_name', 50)->nullable();
            $table->foreignId('location_id')->constrained();
            $table->date('date_of_join');
            $table->date('date_of_birth')->nullable();
            $table->enum('citizenship', ['Malaysian', 'Foreigner'])->nullable();
            $table->string('ic_number', 31)->nullable();
            $table->string('passport_number', 100)->nullable();
            $table->string('country_of_birth', 20)->nullable();
            $table->string('state_of_birth', 20)->nullable();
            $table->tinyInteger('leave_quota')->nullable();
            $table->foreignId('bank_id')->nullable()->constrained();
            $table->string('accounts', 25)->nullable();
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
