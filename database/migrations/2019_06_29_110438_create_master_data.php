<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('v_key', 255)->comment('gia tri');
            $table->string('v_value')->nullable()->comment('gia tri');
            $table->integer('order_number')->nullable()->comment('gia tri');
            $table->tinyInteger('type')->nullable()->comment('Loại giá trị');
            $table->string('v_content', 1000)->nullable()->comment('noi dung');
            $table->string('url', 1000)->nullable()->comment('URL');
            $table->string('note', 1000)->nullable()->comment('ghi chú');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_data');
    }
}
