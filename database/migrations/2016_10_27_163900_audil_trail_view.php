<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AudilTrailView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          DB::statement('CREATE OR REPLACE VIEW audit_view AS  
 SELECT at.id,
    at.mf_id,
    at.case_name,
    at.description,
    at.created_at,
    concat(m.surname, \' \', m.firstname) AS user_name
   FROM audit_trails at
     LEFT JOIN masterfiles m ON at.mf_id = m.id;');
    
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
