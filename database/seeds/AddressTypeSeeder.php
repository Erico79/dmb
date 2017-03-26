<?php

use Illuminate\Database\Seeder;
use App\AddressType;

class AddressTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $main = new AddressType;
        $main->address_type_name = 'Main';
        $main->address_type_code = 'MAIN';
        $main->address_type_status = 1;
        $main->save();

        $office = new AddressType();
        $office->address_type_name = 'Office';
        $office->address_type_code = 'OFFICE';
        $office->address_type_status = 1;
        $office->save();

        $home = new AddressType();
        $home->address_type_name = 'Home';
        $home->address_type_code = 'HOME';
        $home->address_type_status = 1;
        $home->save();
    }
}
