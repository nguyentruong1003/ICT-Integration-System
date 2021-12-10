<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeCertificateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_certificate', function (Blueprint $table) {
            $table->id();
            $table->foreignId('emp_id')->constrained('employee');
            $table->string('name')->comment("Tên chứng chỉ");
            $table->string('place')->nullable()->comment('');
            $table->date('issued_date')->nullable()->comment("Ngày cấp");
            $table->float('score')->nullable()->comment("Điểm số");
            $table->unsignedTinyInteger('status')->nullable()->comment("Tình trạng");
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
        Schema::dropIfExists('employee_certificate');
    }
}
