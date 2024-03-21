<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'category', // Add 'category' to the $fillable array
        'item_code',
        'description',
        'quantity',
        'price',
        'vat_code',
        'discount',
        'discount_type',
        'basic_amount',
        'total_price',
    ];
}
