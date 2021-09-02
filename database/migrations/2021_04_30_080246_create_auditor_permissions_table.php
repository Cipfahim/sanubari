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
            $table->foreignId('employee_id')->constrained();
            $table->foreignId('audit_session_id')->constrained();
            $table->boolean('employee_details')->default(1);
            $table->boolean('contact_details')->default(0);
            $table->boolean('contribution')->default(0);
            $table->boolean('salary_details')->default(0);
            $table->boolean('documents')->default(0);
            $table->boolean('leave')->default(0);
            $table->boolean('payslips')->default(0);
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
