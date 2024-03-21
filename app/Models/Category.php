<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    public function codes()
    {
        return $this->belongsToMany(Code::class, 'category_codes', 'category_id', 'code_id');
    }
}
