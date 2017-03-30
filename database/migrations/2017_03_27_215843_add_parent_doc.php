<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParentDoc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            Schema::table('documents', function (Blueprint $table) {
                $table->bigInteger('parent_doc')->nullable();
                $table->foreign('parent_doc')
                    ->references('id')
                    ->on('documents')
                    ->onUpdate('cascade')
                    ->onDelete('no action');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
