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
        Schema::create('client_properties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_group_id')->unsigned()->index();
            $table->foreign('client_group_id')->references('id')->on('client_groups');
            $table->string('code', 5);
            $table->enum('name', ['Mall' ,'Hotel' ,'Residence' ,'Restaurant' ,'Community' ,'Departement Store' ,'Supermarket' ,'Retail' ,'Entertainment' ,'Others' ,'Transportation' ,'Telecommunication' ,'Bank' ,'Oil & Gas' ,'Goverment' ,'e-commerce' ,'Medicine' ,'Hospital' ,'BUMN / BUMD' ,'Tourist Attraction' ,'Tour & Travel' ,'Insurrance', 'SaaS', 'Manufacture']);
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
        Schema::dropIfExists('client_properties');
    }
}
