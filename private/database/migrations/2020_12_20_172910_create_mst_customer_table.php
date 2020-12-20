<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_customer', function (Blueprint $table) {
            $table->string('id',50)->primary();
            $table->string('company_id',100)->nullable();
            $table->string('advertise_id',100)->nullable();
            $table->string('name');
            $table->string('product_id');
            $table->string('gender_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('consultation')->nullable();
            $table->string('sales_id',100)->nullable();
            $table->string('author',100)->nullable();
            $table->tinyInteger('status');
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
        Schema::dropIfExists('mst_customer');
    }
}
