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
            // column that links to users table
            $table->foreignId('user_id')->constrained();
            // column that links to categories table 
            $table->foreignId('category_id')->constrained();
            $table->string('name');
            $table->string('brand');
            // column that only hold + or 0 numbers
            $table->unsignedInteger('price');
            //                      max no, max no. after decimal 
            $table->decimal('weight', 10, 2);
            $table->text('desc');
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
