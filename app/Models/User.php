<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use LogsActivity;

    protected static $logAttributes = ['*'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Scope a query to only include active users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeExceptEmployee($query)
    {
        return $query->where('role_id', '!=', Role::Employee);
    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function conversations()
    {
        return $this->belongsToMany(Conversation::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function auditorPermissions()
    {
        return $this->hasMany(AuditorPermission::class);
    }

}
