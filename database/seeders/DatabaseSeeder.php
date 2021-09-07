<?php

namespace Database\Seeders;


use App\Models\LeaveQuota;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Call Seeder
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            LocationSeeder::class,
        ]);
    }
}
