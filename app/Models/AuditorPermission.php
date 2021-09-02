<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditorPermission extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'employee_details' => 'boolean',
        'contact_details' => 'boolean',
        'contribution' => 'boolean',
        'salary_details' => 'boolean',
        'documents' => 'boolean',
        'leave' => 'boolean',
        'payslips' => 'boolean',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    static public function hasAccess($session , $employee){
        return  AuditorPermission::where('audit_session_id',$session)->where('employee_id',$employee)->exists();
    }

    static public function auditors(){
       return User::whereHas('role', function (Builder $query) {
            $query->where('slug', 'auditor');
        })->get();
    }
}
