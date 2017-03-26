<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sys_actions', function (Blueprint $table) {
            $table->string('icon')->nullable();
            $table->string('action_type');
            $table->text('attributes')->nullable();
            $table->string('action_category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sys_actions', function (Blueprint $table) {
            //
        });
    }
}
