<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;   
class Category extends Model
{
    use HasFactory;
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
    // Mass assignable //use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];
 public function products()
    {
        return $this->hasMany(Product::class);
    }
}





