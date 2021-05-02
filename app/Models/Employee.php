<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function bank()
    {
        return $this->hasOne(Bank::class);
    }

    public function contactDetails()
    {
        return $this->hasMany(ContactDetails::class);
    }

    public function contributions()
    {
        return $this->belongsTo(Contributions::class);
    }

    public function payslips()
    {
        return $this->belongsTo(Payslips::class);
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
