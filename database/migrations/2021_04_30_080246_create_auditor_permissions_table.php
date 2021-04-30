<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditorPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditor_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained("users");
            $table->foreignId('employee_id')->constrained("employees");
            $table->boolean('basic_info')->default(1);
            $table->boolean('salary_info')->default(0);
            $table->boolean('contribution_info')->default(0);
            $table->boolean('documents')->default(0);
            $table->boolean('payslips')->default(0);
            $table->boolean('log')->default(0);
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
        Schema::dropIfExists('auditor_permissions');
    }
}
