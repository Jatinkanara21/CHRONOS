<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Watch;

class DatabaseSeeder extends Seeder
{
   public function run(): void
    {
    // 1. Create Admin
        \App\Models\User::create([
            'name' => 'Store Admin',
            'email' => 'admin@watchstore.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'is_admin' => true 
        ]);

    // 2. Create Categories
        $categories = ['Automatic', 'Quartz', 'Chronograph', 'Smart', 'Luxury'];
        $catIds = [];
        foreach($categories as $cat) {
            $created = \App\Models\Category::create([
                'name' => $cat,
                'slug' => \Illuminate\Support\Str::slug($cat)
            ]);
            $catIds[] = $created->id;
        }

    // 3. Seed Watches
        $brands = ['Rolex', 'Omega', 'Patek Philippe', 'Audemars Piguet'];
    
        for ($i = 1; $i <= 8; $i++) {
            \App\Models\Watch::create([
                'name' => 'Luxury Chrono ' . $i,
                'brand' => $brands[array_rand($brands)],
                'price' => rand(5000, 50000),
                'description' => 'An exquisite timepiece featuring automatic movement.',
                'image' => 'watches/sample.jpg', 
                'stock' => rand(1, 10),
                'category_id' => $catIds[array_rand($catIds)], // Assign random category
            ]);
        }
    }
}