<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClnVisitPatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cln_visit_patient', function (Blueprint $table) {
            $table->string('id',50)->primary();
            $table->string('company_id',100)->nullable();
            $table->string('advertise_id',100)->nullable();
            $table->string('visit_status_id')->nullable();
            $table->string('gender_id')->nullable();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->text('consultation')->nullable();
            $table->string('reservation_id',100)->nullable();
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
        Schema::dropIfExists('cln_visit_patient');
    }
}
