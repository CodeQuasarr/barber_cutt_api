<?php

namespace App\Models\OtherProduct;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category_product_id',
        'price',
        'is_active',
        'image'
    ];

    public function category()
    {
        return $this->belongsTo(CategoryProduct::class, 'category_product_id');
    }

    public function getIsActiveAttribute($value)
    {
        return $value ? 'Active' : 'Inactive';
    }

    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2);
    }

    public function price(): Attribute {
        return Attribute::make(
            fn($value) => Str::replace('.', ',', $value) . '€'
        );
    }
}
