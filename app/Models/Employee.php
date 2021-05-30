<?php

namespace App\Models;

use App\Enums\EmployeeStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'status' => EmployeeStatusEnum::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bank()
    {
        return $this->hasOne(Bank::class);
    }

    public function contactDetails()
    {
        return $this->hasMany(ContactDetails::class);
    }

    public function contribution()
    {
        return $this->hasOne(Contribution::class);
    }

    public function salaryDetails()
    {
        return $this->hasOne(SalaryDetails::class);
    }

    public function payslips()
    {
        return $this->hasMany(Payslip::class);
    }

    public function location()
    {
        return $this->hasOne(Location::class);
    }

    public function leave()
    {
        return $this->belongsTo(Leave::class);
    }
}
