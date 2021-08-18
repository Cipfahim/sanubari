<?php

namespace App\Models;

use App\Enums\EmployeeStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * @return HasMany
     */
    public function contactDetails(): HasMany
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

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function payslips()
    {
        return $this->hasMany(Payslip::class);
    }

    public function leave()
    {
        return $this->belongsTo(Leave::class);
    }
}
