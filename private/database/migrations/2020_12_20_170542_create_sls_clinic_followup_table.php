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
            $table->string('shipwork_id',50);
            $table->string('advertise_id',50);
            $table->string('interaction_id',50);
            $table->string('gender_id',50);
            $table->string('full_name',100);
            $table->integer('age');
            $table->string('phone',100);
            $table->text('consultation');
            $table->text('address');
            $table->string('city_id',50);
            $table->dateTime('schedule_date',0);
            $table->tinyInteger('lock_status',0);
            $table->string('confirmation_id',50);
            $table->tinyInteger('closing_status');
            $table->string('closing_by',100);
            $table->dateTime('closing_date',0);
            $table->text('img_patient');
            $table->text('img_reservation');
            $table->text('img_conference');
            $table->text('img_closing');
            $table->string('sales_id',50);
            $table->tinyInteger('followup_status');
            $table->dateTime('followup_date',0);
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
