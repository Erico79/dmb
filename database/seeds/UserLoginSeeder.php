<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserLoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mf = \App\Masterfile::where('surname', 'Admin')->first();
        $admin = Role::where('role_code', 'SYS_ADMIN')->first();
        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@admin.com';
        $user->password = bcrypt(123456);
        $user->masterfile_id = $mf->id;
        $user->save();
        $user->roles()->attach($admin);
    }
}
