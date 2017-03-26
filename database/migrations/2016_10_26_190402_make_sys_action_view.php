<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class MakeSysActionView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE OR REPLACE VIEW sys_actions_view AS 
 SELECT sa.id ,
    sa.action_name,
    sa.action_code,
    sa.class,
    sa.route_id,
    sa.action_status,
    sa.user_mfid,
    r.route_name,
    concat(m.surname, \' \', m.firstname) AS user_name
   FROM sys_actions sa
     LEFT JOIN routes r ON sa.route_id = r.id
     LEFT JOIN masterfiles m ON sa.user_mfid = m.id;');
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
