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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('content');
            $table->tinyInteger('status')->default(0)->comment('0:công khai, 1:riêng tư, 2:đã xóa');
            $table->timestamps();
            $table->softDeletes('deleted_at');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;
            $table->foreign('category_id')->references('id')->on('post_categories')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
