<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category',
        'brand',
        'image',
        'price',
        'discount',
        'isNew',
        'availability',
        'description',
        'rating',
        'reviews',
        'reviewsList',
        'isFavorite',
        'ingredients',
        'usage',
        'dosageForm',
        'expiryDate',
        'requiresPrescription',
        'ageRestriction',
        'sideEffects',
        'warning',
        'storage',
    ];

    protected $casts = [
        'reviewsList' => 'array',
        'ingredients' => 'array',
        'isNew' => 'boolean',
        'isFavorite' => 'boolean',
        'requiresPrescription' => 'boolean',
        'expiryDate' => 'date',
    ];
}
