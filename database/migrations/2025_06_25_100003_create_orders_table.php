<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('order_number')->unique();

            // Status from the second version (more detailed)
            $table->enum('status', ['pending', 'placed', 'preparing', 'shipping', 'delivered', 'cancelled', 'returned'])->default('pending');

            $table->integer('quantity')->default(1);

            // Use the larger precision just in case
            $table->decimal('total_amount', 10, 2);

            // From first migration
            $table->string('payment_method');
            $table->string('gcash_number')->nullable();
            $table->text('shipping_address')->nullable();
            $table->string('tracking_number')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
