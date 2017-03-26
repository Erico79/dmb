<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRevenuechannelFks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('revenue_channels', function (Blueprint $table) {
            $table->foreign('ifmis_headcode_id')
                ->references('id')
                ->on('ifmis_headcodes')
                ->onUpdate('cascade');
            $table->foreign('ifmis_subcode_id')
                ->references('id')
                ->on('ifmis_subcodes')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('revenue_channels', function (Blueprint $table) {
            //
        });
    }
}
