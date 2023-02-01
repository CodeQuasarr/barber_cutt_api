<?php

namespace App\Models\Haircuts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HaircutCategory extends Model
{
    use HasFactory;

    // define constants for the haircut categories
    const HAIRECUT = 1;
    const BEARD = 2;
    const MASSAGE = 3;
}
