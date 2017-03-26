<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AllUsersview extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE OR REPLACE VIEW public.users_view AS 
  SELECT u.id,
    u.email,
    u.created_at,
    u.updated_at,
    u.masterfile_id,
    u.status,
    concat(m.surname, \' \', m.firstname) AS user_name
   FROM users u
     LEFT JOIN masterfiles m ON u.masterfile_id = m.id;');
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
