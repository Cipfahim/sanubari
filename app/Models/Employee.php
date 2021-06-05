<?php

namespace App\Models;

use App\Enums\EmployeeStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Employee extends Model
{
    use HasFactory;
    use LogsActivity;

    protected static $logAttributes = ['*'];

    protected $guarded = ['id'];

    protected $casts = [
        'status' => EmployeeStatusEnum::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contactDetails()
    {
        return $this->hasMany(ContactDetails::class);
    }

    public function contactNumbers()
    {
        return $this->hasMany(ContactDetails::class)
            ->where('type', 'number');
    }

    public function contactEmails()
    {
        return $this->hasMany(ContactDetails::class)
            ->where('type', 'email');
    }

    public function contactAddress()
    {
        return $this->hasMany(ContactDetails::class)
            ->where('type', 'address');
    }

    public function contribution()
    {
        return $this->hasOne(Contribution::class);
    }

    public function salaryDetails()
    {
        return $this->hasOne(SalaryDetails::class);
    }

    public function bankDetails()
    {
        return $this->hasOne(BankDetails::class);
    }

    public function payslips()
    {
        return $this->hasMany(Payslip::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function leave()
    {
        return $this->belongsTo(Leave::class);
    }
}
