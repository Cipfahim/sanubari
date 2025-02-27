<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class HonorariumCategory extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $guarded = ['id'];

    protected $casts = [
        'status' => 'boolean'
    ];

    protected static $logAttributes = ['*'];

    public function salary()
    {
        return $this->belongsTo(Salary::class);
    }
}
