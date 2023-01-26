<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;


    //------------------------ User RelationShip -----------------
    public function orders(): BelongsToMany {
        return $this->belongsToMany(Order::class)->withPivot(['total_quantity', 'total_price']);
    }

    public function category(): HasOne {
        return $this->hasOne(Category::class);
    }

    public function price(): Attribute {
        return Attribute::make(
            fn($value) => Str::replace('.', ',', $value) . '€'
        );
    }
}
