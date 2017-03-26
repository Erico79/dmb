<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('roles')->delete();
        $admin = \App\Masterfile::where('surname', 'Admin')->first();
        $sys_admin = new \App\Role();
        $sys_admin->role_name = 'System Administrator';
        $sys_admin->role_code = 'SYS_ADMIN';
        $sys_admin->role_status = 1;
        $sys_admin->user_mfid = $admin->id;
        $sys_admin->save();
    }
}
