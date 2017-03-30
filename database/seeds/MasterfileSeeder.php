<?php

use Illuminate\Database\Seeder;
use App\Masterfile;
use App\CustomerType;

class MasterfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Masterfile();
        $admin->surname = 'Admin';
        $admin->firstname = 'Admin';
        $admin->id_passport = '123456';
        $admin->gender = '1';
        $admin->reg_date = date('Y-m-d');
        $admin->b_role = 'Staff';
        $admin->email = 'admin@admin.com';
        $admin->customer_type_name = 'System Admin';
        $admin->save();

    }
}
