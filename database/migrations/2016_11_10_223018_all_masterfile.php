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
            "CREATE OR REPLACE VIEW all_masterfile AS
                SELECT id_passport,
                   gender,
                   reg_date,
                   b_role, 
                   email, 
                   customer_type_name, 
                   concat(surname,' ',firstname,' ',middlename) AS full_name
                FROM masterfiles 
                WHERE b_role = 'Staff' "
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
