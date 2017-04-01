<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AllMasterfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(
            "CREATE VIEW all_masterfile AS SELECT masterfiles.id_passport,
                masterfiles.gender,
                masterfiles.reg_date,
                masterfiles.b_role,
                masterfiles.email,
                masterfiles.customer_type_name,
                masterfiles.id,
                masterfiles.surname,
                masterfiles.firstname,
                masterfiles.middlename,
                concat(masterfiles.surname, ' ', masterfiles.firstname, ' ', masterfiles.middlename) AS full_name
               FROM masterfiles"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
