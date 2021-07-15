<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Unit;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->date('birth_date')->nullable();
            $table->string('description')->nullable();
            $table->string('address')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamps();
            $table->string('updated_by')->nullable();
            $table->string('unit');
            $table->boolean('admin');
            $table->rememberToken();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('unit')->references('unit_name')->on('units')->onDelete('cascade');
            //($users->unit = ((Unit::find('unit_name')->unit_father)? Unit::find('unit_name')->unit_father : 'None'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
