<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIfmisSubcodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ifmis_subcodes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subcode_name');
            $table->bigInteger('ifmis_headcode_id');
            $table->string('ifmis_subcode')->nullable();
            $table->foreign('ifmis_headcode_id')
                ->references('id')
                ->on('ifmis_headcodes')
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
        Schema::dropIfExists('ifmis_subcodes');
    }
}
