<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payslip extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public static function generateDescription($date): string
    {
        return 'Pay Slip ' . Carbon::parse($date)->format('Y M');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
