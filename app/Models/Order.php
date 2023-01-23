<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;


    //------------------------ User RelationShip -----------------
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot(['total_quantity', 'total_price']);
    }
}
