<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Skincare',
            'description' => 'Products focused on maintaining and enhancing skin health.',
            'images' => json_encode(['/storage/categories/skincare.jpg']), // Replace with actual paths
        ]);
    }
}
