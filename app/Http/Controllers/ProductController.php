<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    // 1️⃣ List all products
   public function index()
{
    $products = Product::with('subcategory.category')->get();
    return ProductResource::collection($products);
}

    // 2️⃣ Store a new product
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());
        return new ProductResource($product);
    }

    // 3️⃣ Show a single product
    public function show(Product $product)
    {
        $product->load('category'); // load category relation
        return new ProductResource($product);
    }

    
   // 4️⃣ Update a product
public function update(UpdateProductRequest $request, Product $product)
{
    $product->update($request->validated());

    // Load subcategory and its category
    $product->load('subcategory.category');

    return new ProductResource($product);
}


    // 5️⃣ Delete a product
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            'message' => 'Product deleted successfully'
        ], 200);
    }
}

