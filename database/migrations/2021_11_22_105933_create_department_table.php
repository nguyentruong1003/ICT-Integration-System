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
            $table->string('description')->nullable()->comment("Mô tả");
            $table->string('note')->nullable()->comment("Ghi chú");
            $table->tinyInteger('status')->default('1')->comment("Trạng thái: 1 => Hoạt động, 2 => Không hoạt động");
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
