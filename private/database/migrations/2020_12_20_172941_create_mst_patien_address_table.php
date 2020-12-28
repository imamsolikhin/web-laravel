<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstPatienAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_patien_address', function (Blueprint $table) {
            $table->string('id',50)->primary();
            $table->string('company_id',100)->nullable();
            $table->string('customer_id',100)->nullable();
            $table->text('address')->nullable();
            $table->text('address_no')->nullable();
            $table->text('rt')->nullable();
            $table->text('rw')->nullable();
            $table->text('village')->nullable();
            $table->text('sub_district')->nullable();
            $table->text('benchmark')->nullable();
            $table->text('district')->nullable();
            $table->text('city')->nullable();
            $table->text('province')->nullable();
            $table->text('postal_code')->nullable();
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
        Schema::dropIfExists('mst_patien_address');
    }
}
