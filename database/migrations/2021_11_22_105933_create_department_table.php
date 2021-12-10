<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('code')->comment("Mã đơn vị");
            $table->string('name')->comment("Tên đơn vị");
            $table->bigInteger('leader_id')->nullable()->comment('Trưởng phòng');
            $table->string('description')->nullable()->comment("Mô tả");
            $table->string('note')->nullable()->comment("Ghi chú");
            $table->tinyInteger('status')->default('1')->comment("Trạng thái: 1 => Hoạt động, 2 => Không hoạt động");
            $table->integer('created_by')->nullable()->comment('Người tạo - Map với user');
            $table->integer('updated_by')->nullable()->comment('Người cập nhật - Map với user');
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
        Schema::dropIfExists('units');
    }
}
