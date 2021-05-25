<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate([
            'name' => "System Admin",
            "email" => "systemadmin@mail.com",
            "phone" => "01701234567",
        ], [
            "password" => Hash::make('password'),
            "role_id" => Role::SystemAdmin,
        ]);

        User::updateOrCreate([
            'name' => "Admin",
            "email" => "admin@mail.com",
            "phone" => "01701234568",
        ], [
            "password" => Hash::make('password'),
            "role_id" => Role::Admin,
        ]);

        User::updateOrCreate([
            'name' => "Jhon Doe",
            "email" => "user@mail.com",
            "phone" => "01701234566",
        ], [
            "password" => Hash::make('password'),
            "role_id" => Role::Employee,
        ]);
    }
}
