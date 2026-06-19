<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'icon',
        'image',
        'features',
        'price_range',
        'is_active',
        'order'
    ];
    
    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
    ];
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
}