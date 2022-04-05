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
            $table->string('name')->comment("Họ tên");
            $table->string('email')->comment("Email");
            $table->string('phone')->comment("SĐT");
            $table->date('birthday')->comment("Ngày sinh");
            $table->tinyInteger('sex')->comment("Giới tính: 1 = Nam, 2 = Nữ");
            $table->unsignedBigInteger('position_id')->nullable()->comment("Chức vụ");
            $table->unsignedBigInteger('working_address_id')->nullable()->comment('Địa điểm làm việc');
            $table->unsignedBigInteger('manager_id')->nullable()->comment('Người quản lý');
            $table->unsignedBigInteger('user_id')->nullable()->comment('Map với user');
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
        Schema::dropIfExists('employees');
    }
}
