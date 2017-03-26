<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('masterfile_id');
            $table->string('county');
            $table->string('town');
            $table->string('postal_address');
            $table->string('postal_code');
            $table->string('address_type_name');
            $table->string('ward')->nullable();
            $table->string('street')->nullable();
            $table->string('building')->nullable();
            $table->string('house_no')->nullable();
            $table->bigInteger('phone');
            $table->timestamps();
            $table->foreign('masterfile_id')
                ->references('id')
                ->on('masterfiles')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
