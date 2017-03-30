<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('transaction_id');
            $table->double('cash_paid');
            $table->string('receiptnumber');
            $table->timestamp('transaction_date');
            $table->string('service_account');
            $table->text('details')->nullable();
            $table->bigInteger('transacted_by')
                ->foreign('transacted_by')
                ->references('id')
                ->on('masterfiles')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->bigInteger('customer_bill_id')->nullable();
            $table->bigInteger('service_channel_id')
                ->foreign('service_channel_id')
                ->references('id')
                ->on('service_channels')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('reference_code')->nullable();
            $table->bigInteger('masterfile_id')
                ->foreign('masterfile_id')
                ->references('id')
                ->on('masterfiles')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('payment_mode');
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
        Schema::dropIfExists('transactions');
    }
}
