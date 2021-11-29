<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Support\Str;
use App\Models\City;
use Khsing\World\World;
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
        $countries = World::Countries();
//        dd($countries);
        foreach ($countries as $data) {
            $country = Country::create([
                'name' => $data->name,
                'slug' => Str::slug($data->name),
                'flag_path' => $data->emoji,
                'country_code' => $data->callingcode
            ]);

            foreach ($data->cities as $city) {
                City::create([
                    'country_id' => $country->id,
                    'name' => $city->name,
                    'slug' => Str::slug($city->name)
                ]);
            }
        }
    }
}
