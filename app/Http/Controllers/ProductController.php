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
        
        // Debug: Let's see what we're actually getting
        return response()->json([
            'debug_info' => [
                'total_products' => $products->count(),
                'raw_products' => $products->toArray(),
                'first_product_raw' => $products->first() ? $products->first()->toArray() : null,
                'relationships_loaded' => $products->first() ? [
                    'has_subcategory' => $products->first()->subcategory ? true : false,
                    'subcategory_data' => $products->first()->subcategory ? $products->first()->subcategory->toArray() : null,
                    'has_category' => ($products->first()->subcategory && $products->first()->subcategory->category) ? true : false
                ] : null
            ],
            'formatted_data' => ProductResource::collection($products)
        ]);
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

