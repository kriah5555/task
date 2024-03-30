<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Image;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'title', 
        'description', 
        'user_id',
        'date',
        'image_id',
    ];

    protected $casts = [
        'date' => 'date'
    ];

    // protected $appends = ['image_url'];

    // public function getImageUrlAttribute()
    // {
    //     if ($this->image) {
    //         return asset('storage/' . $this->image->image_path);
    //     } else {
    //         return ''; 
    //     }
    // }

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($post) {
    //         if (! $post->user_id) {
    //             $post->user_id = Auth::id();
    //         }
    //     });
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
