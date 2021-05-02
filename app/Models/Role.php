<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    const SystemAdmin = 1;
    const Admin = 2;
    const Auditor = 3;
    const Employee = 4;

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
