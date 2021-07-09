<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserManageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user-manage', function (Blueprint $table) {
            $table->id();
            $table->string('user_name');
            $table->string('description')->nullable();
            $table->date('date_of_birth');
            // $table->timestamp('created_at')->nullable();
            $table->string('address');
            $table->string('create_by')->references('name')->on('users');
            // $table->timestamp('update_at');
            $table->timestamps();
            $table->string('update_by')->references('name')->on('users');
            $table->string('unit')->references('unit_name')->on('units');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
