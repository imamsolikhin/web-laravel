<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlsProductCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sls_product_customer', function (Blueprint $table) {
          $table->string('id')->primary();
          $table->string('company_id')->nullable();
          $table->string('shift_work_id')->nullable();
          $table->string('product_id')->nullable();
          $table->string('advertise_id')->nullable();
          $table->string('customer_id')->nullable();
          $table->string('customer_address_id')->nullable();
          $table->integer('quantity')->nullable();
          $table->decimal('price', $precision = 8, $scale = 2)->nullable();
          $table->decimal('courier_cost', $precision = 8, $scale = 2)->nullable();
          $table->decimal('insurance', $precision = 8, $scale = 2)->nullable();
          $table->string('market_id')->nullable();
          $table->string('courier_id')->nullable();
          $table->string('payment_type_id')->nullable();
          $table->string('bank_id')->nullable();
          $table->dateTime('transaction_date')->nullable();
          $table->dateTime('delivery_date')->nullable();
          $table->tinyInteger('confirm_status')->nullable();
          $table->string('confirm_by')->nullable();
          $table->dateTime('confirm_date')->nullable();
          $table->tinyInteger('warehouse_status')->nullable();
          $table->string('warehouse_by')->nullable();
          $table->dateTime('warehouse_date')->nullable();
          $table->tinyInteger('closing_status')->nullable();
          $table->string('closing_by')->nullable();
          $table->dateTime('closing_date')->nullable();
          $table->string('packing_id')->nullable();
          $table->dateTime('packing_date')->nullable();
          $table->text('img_transaction')->nullable();
          $table->text('img_packing')->nullable();
          $table->text('img_delivery')->nullable();
          $table->string('sales_id')->nullable();
          $table->string('author')->nullable();
          $table->string('status')->nullable();
          $table->string('created_by')->nullable();
          $table->string('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sls_product_customer');
    }
}
