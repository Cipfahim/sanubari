<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payslip extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Scope a query to only include active users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSuccess($query)
    {
        return $query->where('employee_id', '!=', null);
    }

    /**
     * Scope a query to only include active users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFailed($query)
    {
        return $query->where('employee_id', null);
    }


    public static function generateDescription($date): string
    {
        return 'Pay Slip ' . Carbon::parse($date)->format('Y M');
    }

    public function payslipSession()
    {
        return $this->belongsTo(PayslipSession::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
