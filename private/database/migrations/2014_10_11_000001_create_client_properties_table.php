<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_client_properties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_group_id')->unsigned()->index();
            $table->foreign('client_group_id')->references('id')->on('sys_client_groups');
            $table->string('code', 5);
            $table->enum('name', ['Clinic','Product']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_client_properties');
    }
}
