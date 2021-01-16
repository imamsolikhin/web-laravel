<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleMenuAuthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_menu_auth', function (Blueprint $table) {
            $table->id();
            $table->string('role_id')->nullable();
            $table->string('menu_id')->nullable();
            $table->string('menu_tools_id')->nullable();
            $table->tinyInteger('view')->default('0');
            $table->tinyInteger('create')->default('0');
            $table->tinyInteger('update')->default('0');
            $table->tinyInteger('delete')->default('0');
            $table->tinyInteger('access')->default('0');
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
        Schema::dropIfExists('role_menu_auth');
    }
}
