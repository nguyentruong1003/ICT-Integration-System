<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignkeyToEmployee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            //
            $table->foreign('ex_ward_id')->references('ward_code')->on('ex_ward');
            $table->foreign('ex_district_id')->references('district_code')->on('ex_district');
            $table->foreign('ex_province_id')->references('province_code')->on('ex_province');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee', function (Blueprint $table) {
            //
            $table->dropForeign('ex_ward_id');
            $table->dropForeign('ex_district_id');
            $table->dropForeign('ex_province_id');
        });
    }
}
