<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('subcategory.category')->get();
        
        // Debug: Check what we're getting
        if ($products->isEmpty()) {
            return response()->json([
                'message' => 'No products found in database',
                'total_products' => $products->count(),
                'suggestion' => 'Create products via POST /api/products first'
            ]);
        }
        
        return ProductResource::collection($products);
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());
        return new ProductResource($product);
    }

    public function show(Product $product)
    {
        $product->load('subcategory.category');
        return new ProductResource($product);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        $product->load('subcategory.category');
        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}

