<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayslipSession extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $appends = ['label'];

    /**
     * Get the user's first name.
     *
     * @param string $value
     * @return string
     */
    public function getLabelAttribute()
    {
        return Carbon::parse($this->date_from)->toFormattedDateString()
            . ' - ' . Carbon::parse($this->date_to)->toFormattedDateString();
    }

    public static function generateDescription($date): string
    {
        return 'Pay Slip ' . Carbon::parse($date)->format('Y M');
    }

    public function payslips()
    {
        return $this->hasMany(Payslip::class);
    }
}
