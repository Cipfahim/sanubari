<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::updateOrCreate(['name' => "Dhaka", "slug" => "Dhaka" ]);
        Location::updateOrCreate(['name' => "Sylhet", "slug" => "Sylhet" ]);
        Location::updateOrCreate(['name' => "Comilla", "slug" => "Comilla" ]);
        Location::updateOrCreate(['name' => "Chittagong", "slug" => "Chittagong" ]);

    }
}
