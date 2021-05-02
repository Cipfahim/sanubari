<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CreateHonorariumCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('honorarium_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('description',200)->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
        DB::table('honorarium_categories')->insert(
            array(
                'name' => 'Salary',
                'description' => "Basic Honorarium",
                'status' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('honorarium_categories');
    }
}
