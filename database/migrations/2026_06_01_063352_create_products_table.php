<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {

            $table->id();

            $table->string('name');

            $table->text('description')->nullable();

            $table->string('image')->nullable();

            $table->decimal('price', 12, 2);

            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');

            $table->foreignId('sub_category_id')->nullable()->constrained('sub_categories')->onDelete('set null');

            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};