<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id(); // Khóa chính (Primary Key)
            $table->string('name'); // Tên của thành viên
            $table->string('images')->nullable(); // Đường dẫn hình ảnh của thành viên, có thể null
            $table->text('describe')->nullable(); // Mô tả về thành viên, có thể null
            $table->string('position')->nullable();
            $table->string('link_facebook')->nullable();
            $table->string('link_zalo')->nullable(); // Vị trí của thành viên, có thể null
            $table->timestamps(); // Thêm created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
