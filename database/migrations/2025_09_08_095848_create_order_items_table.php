<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
 {
    Schema::create('order_items', function (Blueprint $table) {
       // $table->id();
       $table->uuid('id')->primary();
        $table->foreignUuid('order_id')->constrained()->cascadeOnDelete();
        $table->foreignUuid('product_id')->constrained()->cascadeOnDelete();
       // $table->foreignId('order_id')->constrained()->onDelete('cascade');
       // $table->foreignId('product_id')->constrained()->onDelete('cascade');
        $table->integer('quantity');
        $table->decimal('price', 8, 2); // price at time of order
        $table->timestamps();
    });
 }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
