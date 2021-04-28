<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "System Admin",
            "email"=> "systemadmin@mail.com",
            "password" => Hash::make('password'),
            "role_id"=>Role::where('slug',"system-admin")->first()->id,
        ]);

        User::create([
            'name' => "Admin",
            "email"=> "admin@mail.com",
            "password" => Hash::make('password'),
            "role_id"=>Role::where('slug',"admin")->first()->id,
        ]);

        User::create([
            'name' => "Jhon Doe",
            "email"=> "user@mail.com",
            "password" => Hash::make('password'),
            "role_id"=>Role::where('slug',"employee")->first()->id,
        ]);
    }
}
