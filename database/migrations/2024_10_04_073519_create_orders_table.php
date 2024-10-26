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
            $table->foreignID('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('invoice_code', 50)->unique();
            $table->string('recipient_name')->nullable();
            $table->string('recipient_email')->nullable();
            $table->string('recipient_phone', 15)->nullable();
            $table->string('applied_discount_code')->nullable();
            $table->enum('payment_method', ['cash','vnpay','momo'])->default('cash');
            $table->string('recipient_name');
            $table->string('recipient_phone', 15);
            $table->string('recipient_address');
            $table->string('applied_discount_code')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0:chờ xác nhận, 1:đang xử lý, 2:đang giao hàng, 3:hoàn thành, 4:yêu cầu hủy, 5:đã hủy');
            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes('deleted_at');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
