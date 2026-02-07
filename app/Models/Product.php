<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        // Relations
        'category_id',

        // Basic info
        'name',
        'brand',
        'manufacturer',

        // Images
        'image',
        'images',

        // Pricing
        'price',
        'discount',

        // Stock & availability
        'stock',
        'availability',

        // Flags
        'isNew',
        'requiresPrescription',

        // Medical info
        'dosageForm',
        'strength',
        'ingredients',
        'usage',
        'expiryDate',

        // Safety
        'sideEffects',
        'warning',
        'storage',

        // Reviews
        'rating',
        'reviews',
        'reviewsList',

        // Regulatory
        'barcode',
        'batch_number',

        // Description
        'description',
    ];

    protected $casts = [
        'images' => 'array',
        'ingredients' => 'array',
        'reviewsList' => 'array',

        'isNew' => 'boolean',
        'requiresPrescription' => 'boolean',

        'price' => 'decimal:2',
        'discount' => 'decimal:2',
        'rating' => 'decimal:2',

        'expiryDate' => 'date',
    ];

    /* =====================
       Relationships
    ====================== */

    // Product → Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Product ❤️ Users (Favorites)
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites')
                    ->withTimestamps();
    }
}
