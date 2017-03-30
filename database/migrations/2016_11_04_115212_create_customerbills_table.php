<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerbillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_bills', function (Blueprint $table) {
            $table->increments('bill_id');
            $table->double('bill_amount');
            $table->date('bill_date');
            $table->string('bill_status');
            $table->double('bill_amount_paid')->nullable();
            $table->double('bill_balance')->nullable();
            $table->bigInteger('billing_file_id')->nullable();
            $table->bigInteger('masterfile_id')
                ->foreign('masterfile_id')
                ->references('id')
                ->on('masterfiles')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->bigInteger('service_channel_id')
                ->foreign('service_channel_id')
                ->references('id')
                ->on('service_channels')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->bigInteger('bill_due_date')->nullable();
            $table->string('service_account');
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
        Schema::dropIfExists('customer_bills');
    }
}
