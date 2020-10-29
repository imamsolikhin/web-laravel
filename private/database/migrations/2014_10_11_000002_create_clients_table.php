<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_group_id')->unsigned()->index();
            $table->foreign('client_group_id')->references('id')->on('client_groups');
            $table->integer('client_property_id')->unsigned()->index();
            $table->foreign('client_property_id')->references('id')->on('client_properties');
            $table->enum('scope_of_level', ['client-group', 'client-property', 'client'])->default('client');
            $table->string('code', 7);
            $table->string('name');
            $table->string('contact_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_address')->nullable();
            $table->decimal('longitude', 9, 6)->nullable()->comment('-180 until 180');
            $table->decimal('latitude', 8, 6)->nullable()->comment('-90 until 90');
            $table->string('twitter_link')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->boolean('active')->default('1');
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
        Schema::dropIfExists('clients');
    }
}
