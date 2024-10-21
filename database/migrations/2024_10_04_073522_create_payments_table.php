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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();  
            $table->unsignedBigInteger('order_id');  
            $table->string('transaction_id')->nullable();  
            $table->enum('status', ['pending', 'success', 'failed', 'canceled'])->default('pending');  
            $table->text('transaction_info')->nullable();  
            $table->timestamp('transaction_time')->nullable();  
            $table->string('bank_code')->nullable();
            $table->string('bank_tran_no')->nullable();
            $table->string('card_type')->nullable();
            $table->timestamps();  
            $table->softDeletes('deleted_at');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
