<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterfiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('surname', 30);
            $table->string('firstname', 30);
            $table->string('middlename', 30)->nullable();
            $table->string('id_passport', 20);
            $table->boolean('gender');
            $table->text('image_path')->nullable();
            $table->date('reg_date');
            $table->string('b_role', 50);
//            $table->string('user_role', 50);
            $table->string('email', 50);
            $table->string('customer_type_name', 50);
            $table->boolean('status')->default('1');
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
        Schema::dropIfExists('masterfiles');
    }
}
