<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; // ← THIS LINE is required

class Motorcycle extends Model
{
    use HasFactory;

    // If you're using ULIDs instead of auto-incrementing IDs:
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'brand',
        'model',
        'year',
        'rental_price',
        'status',
    ];
}
