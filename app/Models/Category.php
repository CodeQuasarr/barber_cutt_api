<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    const HAIRECUT = 1;
    const BEARD = 2;
    const MASSAGE = 3;
}
