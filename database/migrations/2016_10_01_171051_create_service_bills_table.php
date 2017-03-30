<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_bills', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bill_name', 255);
            $table->text('bill_description')->nullable();
            $table->string('bill_category', 50)->nullable();
            $table->string('bill_type', 50)->nullable();
            $table->string('amount_type', 50)->nullable();
            $table->double('amount');
            $table->string('bill_code', 50);
            $table->bigInteger('revenue_channel_id');
            $table->string('bill_interval')->nullable();
            $table->bigInteger('service_channel_id');
            $table->foreign('service_channel_id')
                ->references('id')
                ->on('service_channels')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('service_bills');
    }
}
