<?php

namespace Database\Seeders;

use App\Models\HonorariumCategory;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class HonorariumCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HonorariumCategory::updateOrCreate([
            'name' => 'Salary'
        ], [
            'description' => "Basic Honorarium",
            'status' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
