<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Support\Str;
use Khsing\World\World;
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
        $countries = World::Countries();
//        dd($countries);
        foreach ($countries as $data) {
            Location::create([
                'name' => $data->name,
                'slug' => Str::slug($data->name)
            ]);
        }
    }
}
