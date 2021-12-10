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
            $table->string('key', 255)->comment('key');
            $table->string('value')->nullable()->comment('gia tri');
            $table->integer('order')->nullable()->comment('thứ tự ưu tiên');
            $table->tinyInteger('type')->nullable()->comment('loại');
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
