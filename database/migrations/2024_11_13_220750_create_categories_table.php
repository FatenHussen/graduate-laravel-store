<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->json('images')->nullable(); // Store multiple image paths as JSON
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Insert predefined categories
        
        DB::table('categories')->insert([
            [
                'name' => 'Skincare',
                'description' => 'Products focused on maintaining and enhancing skin health and appearance.',
                'images' => json_encode(['/storage/categories/skincare.jpg']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hair Care',
                'description' => 'Products for nourishing, strengthening, and styling hair.',
                'images' => json_encode(['/storage/categories/haircare.jpg']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Personal Care',
                'description' => 'General products for personal hygiene and daily care routines.',
                'images' => json_encode(['/storage/categories/personalcare.jpg']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Medical Equipment',
                'description' => 'Specialized equipment and tools for healthcare and diagnostics.',
                'images' => json_encode(['/storage/categories/medicalequipment.jpg']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Health Supplements',
                'description' => 'Vitamins, minerals, and herbal supplements for health support.',
                'images' => json_encode(['/storage/categories/healthsupplements.jpg']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cosmetics',
                'description' => 'A range of makeup products for enhancing beauty and self-expression.',
                'images' => json_encode(['/storage/categories/cosmetics.jpg']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
