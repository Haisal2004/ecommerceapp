<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Create categories first
        $electronics = Category::updateOrCreate(['name' => 'Electronics'], ['name' => 'Electronics']);
        $clothing = Category::updateOrCreate(['name' => 'Clothing'], ['name' => 'Clothing']);

        // Create subcategories
        $phones = Subcategory::updateOrCreate(
            ['name' => 'Phones'], 
            ['name' => 'Phones', 'category_id' => $electronics->id]
        );
        $laptops = Subcategory::updateOrCreate(
            ['name' => 'Laptops'], 
            ['name' => 'Laptops', 'category_id' => $electronics->id]
        );
        $shirts = Subcategory::updateOrCreate(
            ['name' => 'Shirts'], 
            ['name' => 'Shirts', 'category_id' => $clothing->id]
        );

        // Create products
        Product::updateOrCreate(
            ['name' => 'iPhone 15'],
            [
                'name' => 'iPhone 15',
                'description' => 'Latest iPhone model',
                'price' => 999.99,
                'stock' => 50,
                'subcategory_id' => $phones->id
            ]
        );

        Product::updateOrCreate(
            ['name' => 'MacBook Pro'],
            [
                'name' => 'MacBook Pro',
                'description' => 'Professional laptop',
                'price' => 1999.99,
                'stock' => 25,
                'subcategory_id' => $laptops->id
            ]
        );

        Product::updateOrCreate(
            ['name' => 'Cotton T-Shirt'],
            [
                'name' => 'Cotton T-Shirt',
                'description' => 'Comfortable cotton shirt',
                'price' => 29.99,
                'stock' => 100,
                'subcategory_id' => $shirts->id
            ]
        );
    }
}