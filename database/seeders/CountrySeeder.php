<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::updateOrCreate(['name' => 'Malaysia'], ['slug' => 'malaysia']);
        Country::updateOrCreate(['name' => 'Bhutan'], ['slug' => 'bhutan']);
    }
}
