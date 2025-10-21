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
        $electronics = Category::firstOrCreate(['name' => 'Electronics'], [
            'name' => 'Electronics',
            'description' => 'Electronic devices and gadgets'
        ]);
        
        $clothing = Category::firstOrCreate(['name' => 'Clothing'], [
            'name' => 'Clothing',
            'description' => 'Apparel and fashion items'
        ]);

        // Create subcategories
        $phones = Subcategory::firstOrCreate(['name' => 'Phones'], [
            'name' => 'Phones',
            'description' => 'Mobile phones and smartphones',
            'category_id' => $electronics->id
        ]);
        
        $laptops = Subcategory::firstOrCreate(['name' => 'Laptops'], [
            'name' => 'Laptops',
            'description' => 'Portable computers',
            'category_id' => $electronics->id
        ]);
        
        $shirts = Subcategory::firstOrCreate(['name' => 'Shirts'], [
            'name' => 'Shirts',
            'description' => 'Casual and formal shirts',
            'category_id' => $clothing->id
        ]);

        // Create products
        Product::firstOrCreate(['name' => 'iPhone 15'], [
            'name' => 'iPhone 15',
            'description' => 'Latest iPhone model with advanced features',
            'price' => 999.99,
            'stock' => 50,
            'subcategory_id' => $phones->id
        ]);

        Product::firstOrCreate(['name' => 'MacBook Pro'], [
            'name' => 'MacBook Pro',
            'description' => 'Professional laptop for developers',
            'price' => 1999.99,
            'stock' => 25,
            'subcategory_id' => $laptops->id
        ]);

        Product::firstOrCreate(['name' => 'Cotton T-Shirt'], [
            'name' => 'Cotton T-Shirt',
            'description' => 'Comfortable 100% cotton shirt',
            'price' => 29.99,
            'stock' => 100,
            'subcategory_id' => $shirts->id
        ]);

        echo "ProductSeeder completed successfully!\n";
        echo "Created categories: " . Category::count() . "\n";
        echo "Created subcategories: " . Subcategory::count() . "\n";
        echo "Created products: " . Product::count() . "\n";
    }
}