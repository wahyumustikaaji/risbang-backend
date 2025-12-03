<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'order_number',
        'name',
        'slug',
        'image',
    ];

    protected static function boot()
    {
        parent::boot();

        // Generate slug otomatis saat create
        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });

        // Update slug otomatis jika name berubah
        static::updating(function ($category) {
            if ($category->isDirty('name')) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    public function statements()
    {
        return $this->hasMany(Statement::class);
    }
}
