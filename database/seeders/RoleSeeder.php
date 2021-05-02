<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::updateOrCreate(['name' => 'System Admin'], ['slug' => 'system-admin']);
        Role::updateOrCreate(['name' => 'Admin'], ['slug' => 'admin']);
        Role::updateOrCreate(['name' => 'Auditor'], ['slug' => 'auditor']);
        Role::updateOrCreate(['name' => 'Employee'], ['slug' => 'employee']);
    }
}
