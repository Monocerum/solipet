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
        // No longer needed. Price column is handled in create_carts_table.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('carts') && Schema::hasColumn('carts', 'price')) {
            Schema::table('carts', function (Blueprint $table) {
                $table->dropColumn('price');
            });
        }
    }
}; 