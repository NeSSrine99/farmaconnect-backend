<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::truncate();

        $categories = [
            'Médicaments',
            'Homeopathic',
            'Parapharmacie',
            'Compléments alimentaires',
            'Beauté Soins',
            'Bébé Maman',
            'Bio Médecines naturelles',
            'Matériel médical',
            'Promotion',
        ];

        foreach ($categories as $name) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $name . ' products',
            ]);
        }
    }
}
