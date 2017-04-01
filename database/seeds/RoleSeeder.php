<?php

use Illuminate\Database\Seeder;
use App\Role;

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
        $sys_admin = new Role();
        $sys_admin->role_name = 'System Administrator';
        $sys_admin->role_code = 'SYS_ADMIN';
        $sys_admin->role_status = 1;
        $sys_admin->user_mfid = $admin->id;
        $sys_admin->save();

        $staff = new Role();
        $staff->role_name = 'Staff';
        $staff->role_code = 'STAFF';
        $staff->role_status = 1;
        $staff->user_mfid = $admin->id;
        $staff->save();

        $client = new Role();
        $client->role_name = 'Client';
        $client->role_code = 'CLIENT';
        $client->role_status = 1;
        $client->user_mfid = $admin->id;
        $client->save();
    }
}
