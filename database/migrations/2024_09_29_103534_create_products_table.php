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
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image');
            $table->decimal('price');
            $table->integer('discount')->default(0);
            $table->integer('stock')->default(0);
            $table->integer('view')->default(0);
            $table->tinyInteger('status')->default(0)->comment('0:none, 1:sp hot');
            $table->boolean('is_hidden')->default('0')->comment('0:hiển thị, 1:ẩn');
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('product_categories')->onDelete('cascade');
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
