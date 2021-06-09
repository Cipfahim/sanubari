<?php

namespace Database\Seeders;

use App\Enums\EmployeeStatusEnum;
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
            'status' => EmployeeStatusEnum::Active
        ]);

        User::updateOrCreate([
            'name' => "Admin",
            "phone" => "01701234568",
        ], [
            "password" => Hash::make('password'),
            "role_id" => Role::Admin,
            'status' => EmployeeStatusEnum::Active
        ]);

        User::updateOrCreate([
            'name' => "Jhon Doe",
            "phone" => "017012345638",
        ], [
            "password" => Hash::make('password'),
            "role_id" => Role::Employee,
            'status' => EmployeeStatusEnum::Active
        ]);
        User::updateOrCreate([
            'name' => "Auditor Person",
            "phone" => "0170123456448",
        ], [
            "password" => Hash::make('password'),
            "role_id" => Role::Auditor,
            'status' => EmployeeStatusEnum::Active
        ]);
    }
}
