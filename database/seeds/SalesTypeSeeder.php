<?php

use Illuminate\Database\Seeder;
use \App\SalesType;

class SalesTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sale_type = new SalesType();
        $sale_type->sale_type_name = 'Buy Now Purchase';
        $sale_type->sale_type_code = 'BUY_NOW';
        $sale_type->save();

        $sale_type = new \App\SalesType;
        $sale_type->sale_type_name = 'Ordinary Purchase';
        $sale_type->sale_type_code = 'ORDINARY_PURCHASE';
        $sale_type->save();

        $sale_type = new \App\SalesType;
        $sale_type->sale_type_name = 'Auction Purchase';
        $sale_type->sale_type_code = 'AUCTION_PURCHASE';
        $sale_type->save();
    }
}
