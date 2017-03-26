<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('action_description');
            $table->string('action_name');
            $table->string('action_code');
            $table->text('class');
            $table->bigInteger('route_id');
            $table->boolean('action_status')->default(1);
            $table->bigInteger('user_mfid');
            $table->timestamps();

            $table->foreign('route_id')
                ->references('id')
                ->on('routes')
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
        Schema::dropIfExists('sys_actions');
    }
}
