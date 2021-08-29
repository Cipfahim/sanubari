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
            $table->id()->from(2000);
            $table->string('employee_number')->unique()->nullable();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->enum('sex', ['Male', 'Female'])->nullable();
            $table->string('official_name', 50);
            $table->string('nick_name', 50)->nullable();
            $table->foreignId('location_id')->constrained();
            $table->date('date_of_join');
            $table->date('date_of_birth')->nullable();
            $table->foreignId('country_id')->nullable(); //nationality
            $table->string('ic_number', 31)->nullable();
            $table->string('passport_number', 100)->nullable();
            $table->date('passport_issue_date')->nullable();
            $table->date('passport_expiry_date')->nullable();
            $table->string('passport_issuing_authority')->nullable();
            $table->foreignId('birth_country_id')->nullable();
            $table->foreignId('birth_city_id')->nullable(); // Birth state or city
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
