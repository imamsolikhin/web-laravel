<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_group_id')->unsigned()->index();
            $table->foreign('client_group_id')->references('id')->on('sys_client_groups');
            $table->integer('client_property_id')->nullable()->unsigned()->index();
            $table->foreign('client_property_id')->references('id')->on('sys_client_properties');
            $table->integer('client_id')->nullable()->unsigned()->index();
            $table->foreign('client_id')->references('id')->on('sys_clients');
            $table->string('name');
            $table->string('email')->index();
            $table->string('username')->index();
            $table->string('password');
            $table->boolean('active')->default('1');
            $table->boolean('billing_recipient')->default(0);
            $table->dateTime('last_login')->nullable();
            $table->string('api_token', 60)->nullable();
            $table->string('forgot_password_token', 20)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('sys_users');
    }
}
