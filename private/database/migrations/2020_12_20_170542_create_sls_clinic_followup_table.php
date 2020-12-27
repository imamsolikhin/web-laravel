<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlsClinicFollowupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sls_clinic_followup', function (Blueprint $table) {
            $table->string('id',50)->primary();
            $table->string('company_id',50);
            $table->string('shift_work_id',50);
            $table->string('advertise_id',50)->nullable();
            $table->string('interaction_id',50)->nullable();
            $table->string('gender_id',50)->nullable();
            $table->string('full_name',100)->nullable();
            $table->integer('age')->nullable();
            $table->string('phone',100)->nullable();
            $table->text('consultation')->nullable();
            $table->text('address')->nullable();
            $table->string('city_id',50)->nullable();
            $table->dateTime('schedule_date',0)->nullable();
            $table->tinyInteger('lock_status',0)->nullable();
            $table->string('confirmation_id',50)->nullable();
            $table->tinyInteger('reservation_status')->nullable();
            $table->string('reservation_by',100)->nullable();
            $table->dateTime('reservation_date',0)->nullable();
            $table->tinyInteger('closing_status')->nullable();
            $table->string('closing_by',100)->nullable();
            $table->dateTime('closing_date',0)->nullable();
            $table->text('img_patient')->nullable();
            $table->text('img_reservation')->nullable();
            $table->text('img_conference')->nullable();
            $table->text('img_closing')->nullable();
            $table->string('sales_id',50)->nullable();
            $table->tinyInteger('followup_status')->nullable();
            $table->dateTime('followup_date',0)->nullable();
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
        Schema::dropIfExists('sls_clinic_followup');
    }
}
