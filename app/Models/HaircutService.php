<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class HaircutService extends Model
{
    use HasFactory;

    public function price(): Attribute {
        return Attribute::make(
            fn($value) => Str::replace('.', ',', $value) . '€'
        );
    }
}
