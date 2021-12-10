<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeAcademicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_academic', function (Blueprint $table) {
            $table->id();
            $table->foreignId('emp_id')->constrained('employee');
            $table->string('school')->nullable()->comment('Trường');
            $table->string('major')->nullable()->comment("Chuyên ngành");
            $table->unsignedBigInteger('rank_id')->nullable()->comment("Loại tốt nghiệp");
            $table->unsignedInteger('graduated_year')->nullable()->comment("Năm tốt nghiệp");
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
        Schema::dropIfExists('employee_academic');
    }
}
