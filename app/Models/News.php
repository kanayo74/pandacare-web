<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'type',
        'image',
        'author',
        'published_at',
        'is_published',
        'views'
    ];
    
    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
    ];
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
}