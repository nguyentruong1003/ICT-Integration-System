<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('code')->comment("Mã nhân viên");
            $table->string('fullname')->comment("Họ tên đầy đủ");
            $table->string('email')->comment("Email");
            $table->string('phone')->comment("SĐT");
            $table->date('birthday')->comment("Ngày sinh");
            // $table->foreignId('unit_id')->nullable()->comment("Đơn vị")->constrained('unit');
            $table->string('ex_ward_id')->length(5)->nullable()->comment("Xã/Phường");
            $table->string('ex_district_id')->length(5)->nullable()->comment("Huyện/Quận");
            $table->string('ex_province_id')->length(5)->nullable()->comment("Tỉnh/Thành phố");
            $table->string('address')->nullable()->comment("Địa chỉ cụ thể");
            $table->string('description')->nullable()->comment("Mô tả");
            $table->string('note')->nullable()->comment("Ghi chú");
            $table->foreignId('created_by')->comment("Người tạo")->constrained('users');
            $table->foreignId('updated_by')->comment("Người cập nhật")->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee');
    }
}
