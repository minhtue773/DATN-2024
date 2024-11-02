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
            $table->unsignedBigInteger('product_category_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image');
            $table->decimal('price',10,2);
            $table->integer('discount')->nullable();
            $table->integer('stock');
            $table->integer('view')->default(0);
            $table->tinyInteger('status')->default(0)->comment('0:none, 1:sản phẩm mới, 2:sản phẩm hot, 3:sắp hết hàng, 4:hết hàng, 5:ngừng bán');
            $table->boolean('is_hidden')->default(0)->comment('0:hiển thị, 1:ẩn');
            $table->timestamps();
            $table->timestamp('post_date')->nullable();
            $table->softDeletes('deleted_at');
            $table->foreign('product_category_id')->references('id')->on('product_categories');
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
