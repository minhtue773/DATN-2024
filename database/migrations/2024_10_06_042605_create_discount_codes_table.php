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
        Schema::create('discount_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Mã voucher
            $table->enum('type', ['percentage', 'fixed', 'percentage_with_cap']); // Loại voucher
            $table->decimal('discount', 8, 2); // Phần trăm giảm hoặc số tiền giảm
            $table->decimal('max_discount', 8, 2)->nullable(); // Giới hạn giảm giá tối đa cho loại percentage_with_cap
            $table->integer('quantity')->default(1); // Số lượng mã có thể sử dụng
            $table->integer('used_count')->default(0); // Số lần mã đã được sử dụng
            $table->date('expiry_date'); // Ngày hết hạn
            $table->enum('status', ['active', 'expired', 'used'])->default('active'); // Trạng thái voucher
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_codes');
    }
};
