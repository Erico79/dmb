<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_channels', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('revenue_channel_id');
            $table->string('service_option');
            $table->string('option_code', 50);
            $table->double('price');
            $table->bigInteger('parent_id')->nullable();
            $table->string('service_option_type')->nullable();
            $table->bigInteger('request_type_id')->nullable();
            $table->boolean('status');
            $table->integer('currency_id')->nullable();
            $table->foreign('revenue_channel_id')
                ->references('id')
                ->on('revenue_channels')
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
        Schema::dropIfExists('service_channels');
    }
}
