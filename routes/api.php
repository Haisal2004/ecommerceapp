<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;

// Public routes
Route::get('/test', function() {
    return response()->json(['message' => 'API is working!']);
});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Routes that require login
Route::middleware('auth:api')->group(function () {

    // USERS
    Route::get('/users', [UserController::class, 'index'])->middleware('permission:view_users');
    Route::post('/users', [UserController::class, 'store'])->middleware('permission:create_users');
    Route::get('/users/{id}', [UserController::class, 'show'])->middleware('permission:view_users');
    Route::put('/users/{id}', [UserController::class, 'update'])->middleware('permission:update_users');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->middleware('permission:delete_users');

    // CATEGORIES
    Route::get('/categories', [CategoryController::class, 'index'])->middleware('permission:view_categories');
    Route::post('/categories', [CategoryController::class, 'store'])->middleware('permission:create_categories');
    Route::get('/categories/{id}', [CategoryController::class, 'show'])->middleware('permission:view_categories');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->middleware('permission:update_categories');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->middleware('permission:delete_categories');

    // SUBCATEGORIES
    Route::get('/subcategories', [SubcategoryController::class, 'index'])->middleware('permission:view_subcategories');
    Route::post('/subcategories', [SubcategoryController::class, 'store'])->middleware('permission:create_subcategories');
    Route::get('/subcategories/{id}', [SubcategoryController::class, 'show'])->middleware('permission:view_subcategories');
    Route::put('/subcategories/{id}', [SubcategoryController::class, 'update'])->middleware('permission:update_subcategories');
    Route::delete('/subcategories/{id}', [SubcategoryController::class, 'destroy'])->middleware('permission:delete_subcategories');

    // PRODUCTS
    Route::get('/products', [ProductController::class, 'index'])->middleware('permission:view_product');
    Route::post('/products', [ProductController::class, 'store'])->middleware('permission:create_product');
    Route::get('/products/{id}', [ProductController::class, 'show'])->middleware('permission:view_product');
    Route::put('/products/{id}', [ProductController::class, 'update'])->middleware('permission:update_product');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->middleware('permission:delete_product');

    // ORDERS
    Route::get('/orders', [OrderController::class, 'index'])->middleware('permission:view_order');
    Route::post('/orders', [OrderController::class, 'store'])->middleware('permission:create_order');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->middleware('permission:view_order');
    Route::put('/orders/{id}', [OrderController::class, 'update'])->middleware('permission:update_order');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->middleware('permission:delete_order');

    // ORDER ITEMS
    Route::get('/order-items', [OrderItemController::class, 'index'])->middleware('permission:view_order_items');
    Route::post('/order-items', [OrderItemController::class, 'store'])->middleware('permission:create_order_items');
    Route::get('/order-items/{id}', [OrderItemController::class, 'show'])->middleware('permission:view_order_items');
    Route::put('/order-items/{id}', [OrderItemController::class, 'update'])->middleware('permission:update_order_items');
    Route::delete('/order-items/{id}', [OrderItemController::class, 'destroy'])->middleware('permission:delete_order_items');
});
