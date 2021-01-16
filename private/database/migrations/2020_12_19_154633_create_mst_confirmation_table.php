<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstConfirmationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_confirmation', function (Blueprint $table) {
            $table->string('id',50)->primary();
            $table->string('company_id',100)->nullable();
            $table->string('name');
            $table->string('author',100)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
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
        Schema::dropIfExists('mst_confirmation');
    }
}
