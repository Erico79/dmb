<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('document_name')->unique();
            $table->bigInteger('created_by');
            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('no action');
            $table->bigInteger('customer_mfid')->nullable();
            $table->foreign('customer_mfid')
                ->references('id')
                ->on('masterfiles')
                ->onUpdate('cascade')
                ->onDelete('no action');
            $table->bigInteger('supplier_mfid')->nullable();
            $table->foreign('supplier_mfid')
                ->references('id')
                ->on('masterfiles')
                ->onUpdate('cascade')
                ->onDelete('no action');
            $table->text('document_path');
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
        Schema::dropIfExists('documents');
    }
}
