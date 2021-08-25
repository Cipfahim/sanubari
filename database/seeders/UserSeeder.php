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
            "phone" => "01701234567",
        ], [
            "password" => Hash::make('password'),
            "role_id" => Role::SystemAdmin,
        ]);

        User::updateOrCreate([
            'name' => "Admin",
            "phone" => "01701234568",
        ], [
            "password" => Hash::make('password'),
            "role_id" => Role::Admin,
        ]);

        User::updateOrCreate([
            'name' => "Jhon Doe",
            "phone" => "017012345638",
        ], [
            "password" => Hash::make('password'),
            "role_id" => Role::Employee,
        ]);
        User::updateOrCreate([
            'name' => "Auditor Person",
            "phone" => "0170123456448",
        ], [
            "password" => Hash::make('password'),
            "role_id" => Role::Auditor,
        ]);
        User::updateOrCreate([
            'name' => "Employee",
            "phone" => "01648633791",
        ], [
            "password" => Hash::make('password'),
            "role_id" => Role::Employee,
        ]);
    }
}
