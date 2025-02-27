<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class BankDetails extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $guarded = ['id'];

    protected static $logAttributes = ['*'];
}
