<?php

use Illuminate\Database\Seeder;
use App\CustomerType;

class CustomerTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $individual = new CustomerType();
        $individual->customer_type_name = 'Individual';
        $individual->customer_type_code = 'INDIVIDUAL';
        $individual->save();

        $buss = new CustomerType();
        $buss->customer_type_name = 'Company';
        $buss->customer_type_code = 'COMPANY';
        $buss->save();
    }
}
