<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
    ];

    /**
     * Auto-generate slug from name
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function ($category) {
            if ($category->isDirty('name')) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    /**
     * Products relation
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
}


// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Str;

// class Category extends Model
// {
//     use HasFactory;

//     protected $fillable = [
//         'name',
//         'slug',
//         'description',
//         'image',
//         'parent_id',
//     ];

//     /**
//      * Generate slug automatically
//      */
//     protected static function boot()
//     {
//         parent::boot();

//         static::creating(function ($category) {
//             if (empty($category->slug)) {
//                 $category->slug = Str::slug($category->name);
//             }
//         });

//         static::updating(function ($category) {
//             if ($category->isDirty('name')) {
//                 $category->slug = Str::slug($category->name);
//             }
//         });
//     }

//     /**
//      * Parent category
//      */
//     public function parent()
//     {
//         return $this->belongsTo(Category::class, 'parent_id');
//     }

//     /**
//      * Children categories
//      */
//     public function children()
//     {
//         return $this->hasMany(Category::class, 'parent_id');
//     }

//     /**
//      * Products in category
//      */
//     public function products()
//     {
//         return $this->hasMany(Product::class);
//     }
// }
