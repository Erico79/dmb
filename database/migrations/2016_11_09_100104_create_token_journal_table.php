<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokenJournalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('token_journal', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('token_mf_id')
                ->foreign('token_mf_id')
                ->refrences('id')
                ->on('masterfiles')
                ->onUpdate('cascade');
            $table->integer('transaction_id')->nullable()
                ->foreign('transaction_id')
                ->refrences('transaction_id')
                ->on('transactions')
                ->onUpdate('cascade');
            $table->dateTime('created_date');
            $table->double('token_amount');
            $table->double('running_balance');
            $table->string('description', 200);
            $table->string('dr_cr', 10);
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
        //
    }
}
