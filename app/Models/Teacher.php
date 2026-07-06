<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Teacher extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'teachers';

    protected $fillable = [
    'name',
    'email',
    'password',
    'subject',
    'grade',
    'priority',
    'days',
    'periods',
    'is_active',
    'is_available',
    'unavailable_date',
    'unavailable_reason'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
    'days' => 'array',
    'periods' => 'array',
    'is_active' => 'boolean',
    'is_available' => 'boolean',
    'unavailable_date' => 'date',
    'password' => 'hashed',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}