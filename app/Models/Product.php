<?php

namespace App\Models;


use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;   

class Product extends Model
{
   // use HasFactory;
 use HasFactory, Notifiable;
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
        'description',
        'price',
        'stock',
        'subcategory_id',
    ];

    // Relationship with category
    // Relationship with subcategory
 public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    // Access category via subcategory
    public function category()
    {
        return $this->hasOneThrough(Category::class, Subcategory::class, 'id', 'id', 'subcategory_id', 'category_id');
    }



// Optional: Access category via subcategory
//public function category()
////{
    //return $this->subcategory->category();
//}

}
