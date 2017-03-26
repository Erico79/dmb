<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatecolumnMesstype extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('message_types', function (Blueprint $table) {
            $table->renameColumn('message_code', 'message_type_code');
            $table->renameColumn('message_name', 'message_type_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('message_types', function (Blueprint $table) {
            //
        });
    }
}
