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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('image'); // product image path
            $table->string('name'); // product title
            $table->decimal('price', 10, 2); // product price
            $table->string('brand')->nullable(); // e.g., '1,234 SOLD'
            $table->float('ratings', 2, 1)->default(0); // product rating (e.g., 4.5)
            $table->string('rating_text')->nullable(); // e.g., '1,234 SOLD'
            $table->string('savings')->nullable(); // e.g., 'Save 20%!'
            $table->json('features')->nullable(); // product features as JSON array
            $table->text('description')->nullable(); // product description
            $table->string('material')->nullable(); // product material
            $table->string('dimensions')->nullable(); // product dimensions
            $table->text('care_instructions')->nullable(); // care instructions
            $table->string('category')->nullable(); // product category
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
