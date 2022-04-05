<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeePrivateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_private', function (Blueprint $table) {
            $table->id();
            $table->foreignId('emp_id')->unique()->constrained('employee')->cascadeOnDelete();
            $table->string('marital_status')->nullable()->comment("Tình trạng hôn nhân");
            $table->string('other_email')->nullable()->comment("Email cá nhân");
            $table->string('address')->nullable()->comment("Hộ khẩu thường chú");
            $table->string('temporary_address')->nullable()->comment("Địa chỉ tạm trú");
            $table->bigInteger('ethnic_id')->nullable()->comment("Dân tộc");
            $table->bigInteger('religion_id')->nullable()->comment('Tôn giáo');
            $table->bigInteger('nationality_id')->nullable()->comment('Quốc tịch');
            $table->string('identity_card')->nullable()->comment("CMND/CCCD");
            $table->date('identity_card_date')->nullable()->comment('Ngày cấp');
            $table->string('identity_card_place')->nullable()->comment('Nơi cấp');
            $table->string('description')->nullable()->comment("Mô tả");
            $table->string('note')->nullable()->comment("Ghi chú");
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
        Schema::dropIfExists('employee_private');
    }
}
