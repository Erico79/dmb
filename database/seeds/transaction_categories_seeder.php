<?php

use Illuminate\Database\Seeder;
use App\TransactionCategory;

class transaction_categories_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tc = new TransactionCategory();
        $tc->transaction_category_name = 'Purchase';
        $tc->save();

        $tc1 =new TransactionCategory();
        $tc1->transaction_category_name = 'Reconciliation';
        $tc1->save();

        $tc1 =new TransactionCategory();
        $tc1->transaction_category_name = 'Buy Service';
        $tc1->save();

//        $tc1 =new TransactionCategory();
//        $tc1->transaction_category_name = 'Reconciliation';
//        $tc1->save();

    }
}
