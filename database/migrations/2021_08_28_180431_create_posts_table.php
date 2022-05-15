<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('id_by_category');
            $table->unsignedBigInteger('ward_id');

            $table->double('price'); // giá gốc
            $table->float('discount')->default(0.0); // phần trăm giảm giá
            $table->double('commission')->default(0.0); // hoa hồng

            $table->unsignedDecimal('acreage'); // diện tích
            $table->unsignedSmallInteger('bedroom')->nullable(); // số lượng phòng ngủ
            $table->unsignedSmallInteger('toilet')->nullable(); // số lượng toilet
            $table->unsignedSmallInteger('floor')->nullable(); // số tầng
            $table->longText('description'); // mô tả

            $table->string('owner_name'); // tên chủ nhà
            $table->string('owner_phone'); // số điện thoại chủ nhà
            $table->string('owner_address'); // địa chỉ chủ nhà

            $table->boolean('is_cheap')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_hide')->default(false);
            $table->boolean('is_rented')->default(false);

            $table->longText('deny_reason')->nullable();

            $table->unsignedSmallInteger('verify_status')->default(1); // 0: đã duyệt, 1: chưa duyệt, 2: từ chối
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('user_id'); // người đăng bài
            $table->unsignedBigInteger('user_update_id')->nullable(); // người cập nhật bài đăng gần nhất

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_update_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ward_id')->references('id')->on('wards')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
