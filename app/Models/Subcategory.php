<?php

namespace App\Models;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'category_id'];

    // UUID primary key setup
    public $incrementing = false;     // disable auto-increment
    protected $keyType = 'string';    // key is string

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    // 🔹 Relationship: Subcategory belongs to Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}


