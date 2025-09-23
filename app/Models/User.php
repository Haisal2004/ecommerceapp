<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;   
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{ 
    use HasApiTokens, HasFactory, Notifiable;

     /**
     * UUID settings
     */
    public $incrementing = false;   // 👈 not auto-increment
    protected $keyType = 'string';  // 👈 UUID is string

    /**
     * Auto-generate UUID when creating a new record
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
    // Mass assignable
    protected $fillable = [
        'name',
        'email',
        'phone',  // Add if you have this column
        'password',
    ];

    // Hidden fields
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Casts
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
