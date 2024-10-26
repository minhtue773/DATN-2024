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
        Schema::create('website_settings', function (Blueprint $table) {
            $table->id(); // Tạo cột ID tự tăng
            $table->string('setting_key')->unique(); // Khoá duy nhất cho từng loại thiết lập
            $table->text('setting_value')->nullable(); // Giá trị thiết lập
            $table->string('description')->nullable(); // Mô tả thiết lập
            $table->timestamps(); // Tạo cột created_at và updated_at
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_settings');
    }
};
