<?php

// database/seeders/DatabaseSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Owner
        User::create([
            'name' => 'Owner Laidback',
            'email' => 'owner@laidback.com',
            'password' => Hash::make('password'),
            'role' => 'owner',
            'phone' => '081234567890',
        ]);

        // Create Cashiers
        User::create([
            'name' => 'Kasir 1',
            'email' => 'cashier1@laidback.com',
            'password' => Hash::make('password'),
            'role' => 'cashier',
            'phone' => '081234567891',
        ]);

        User::create([
            'name' => 'Kasir 2',
            'email' => 'cashier2@laidback.com',
            'password' => Hash::make('password'),
            'role' => 'cashier',
            'phone' => '081234567892',
        ]);

        // Create Categories
        $categories = [
            [
                'name' => 'Coffee',
                'slug' => 'coffee',
                'description' => 'Berbagai jenis kopi pilihan',
                'icon' => '☕',
            ],
            [
                'name' => 'Non-Coffee',
                'slug' => 'non-coffee',
                'description' => 'Minuman tanpa kafein',
                'icon' => '🥤',
            ],
            [
                'name' => 'Food',
                'slug' => 'food',
                'description' => 'Makanan dan snack',
                'icon' => '🍔',
            ],
            [
                'name' => 'Dessert',
                'slug' => 'dessert',
                'description' => 'Makanan penutup',
                'icon' => '🍰',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create Products
        $products = [
            // Coffee
            [
                'category_id' => 1,
                'name' => 'Espresso',
                'slug' => 'espresso',
                'description' => 'Single shot espresso yang kuat',
                'price' => 25000,
                'stock' => 100,
                'is_available' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Americano',
                'slug' => 'americano',
                'description' => 'Espresso dengan air panas',
                'price' => 28000,
                'stock' => 100,
                'is_available' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Cappuccino',
                'slug' => 'cappuccino',
                'description' => 'Espresso dengan steamed milk dan foam',
                'price' => 35000,
                'stock' => 100,
                'is_available' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Cafe Latte',
                'slug' => 'cafe-latte',
                'description' => 'Espresso dengan banyak steamed milk',
                'price' => 35000,
                'stock' => 100,
                'is_available' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Caramel Macchiato',
                'slug' => 'caramel-macchiato',
                'description' => 'Latte dengan caramel sauce',
                'price' => 38000,
                'stock' => 100,
                'is_available' => true,
            ],
            
            // Non-Coffee
            [
                'category_id' => 2,
                'name' => 'Matcha Latte',
                'slug' => 'matcha-latte',
                'description' => 'Green tea latte premium',
                'price' => 35000,
                'stock' => 100,
                'is_available' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Chocolate',
                'slug' => 'chocolate',
                'description' => 'Hot/Iced chocolate',
                'price' => 30000,
                'stock' => 100,
                'is_available' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Thai Tea',
                'slug' => 'thai-tea',
                'description' => 'Teh susu khas Thailand',
                'price' => 28000,
                'stock' => 100,
                'is_available' => true,
            ],
            
            // Food
            [
                'category_id' => 3,
                'name' => 'Croissant',
                'slug' => 'croissant',
                'description' => 'Butter croissant segar',
                'price' => 25000,
                'stock' => 50,
                'is_available' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Sandwich',
                'slug' => 'sandwich',
                'description' => 'Sandwich dengan berbagai isian',
                'price' => 35000,
                'stock' => 50,
                'is_available' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'French Fries',
                'slug' => 'french-fries',
                'description' => 'Kentang goreng crispy',
                'price' => 20000,
                'stock' => 50,
                'is_available' => true,
            ],
            
            // Dessert
            [
                'category_id' => 4,
                'name' => 'Cheesecake',
                'slug' => 'cheesecake',
                'description' => 'New York style cheesecake',
                'price' => 40000,
                'stock' => 30,
                'is_available' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'Tiramisu',
                'slug' => 'tiramisu',
                'description' => 'Italian classic dessert',
                'price' => 45000,
                'stock' => 30,
                'is_available' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        $this->command->info('Database seeded successfully!');
        $this->command->info('Owner: owner@laidback.com / password');
        $this->command->info('Cashier: cashier1@laidback.com / password');
    }
}