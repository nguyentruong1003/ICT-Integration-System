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
            $table->tinyInteger('type')->comment('1:POSSITION chuc danh ; 2: dan toc; 3 : ton giao; 4: quoc tich; 5: trinh do hoc van; 6: xep loai');
            $table->string('v_value_en')->nullable()->comment('gia tri');
            $table->bigInteger('parent_id')->nullable()->comment('danh muc cha neu co');
            $table->string('v_content', 1000)->nullable()->comment('noi dung');
            $table->string('v_content_en', 1000)->nullable()->comment('noi dung en');
            $table->string('url', 1000)->nullable()->comment('URL');
            $table->string('image', 1000)->nullable()->comment('duong dan anh');
            $table->string('note', 1000)->nullable()->comment('ghi chú');
            $table->string('note_en', 1000)->nullable()->comment('ghi chu en');
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
