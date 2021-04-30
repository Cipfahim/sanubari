<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            "System Admin",
            "Admin",
            "Auditor",
            "Employee"
        ];
        foreach($roles as $role){
            Role::create([
            'name' => $role,
            'slug' => Str::slug($role),
        ]);
        
        }
    }
}
