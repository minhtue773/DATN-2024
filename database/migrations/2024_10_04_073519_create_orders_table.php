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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('total_price');
            $table->tinyInteger('status')->default(0)->comment('0: Đang xử lý, 1: Đã hoàn thành, 2: Đã hủy');
            $table->tinyInteger('payment_status')->default(0)->comment('0: Chưa thanh toán, 1: Đã thanh toán');
            $table->string('shipping_address');
            $table->text('note')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
