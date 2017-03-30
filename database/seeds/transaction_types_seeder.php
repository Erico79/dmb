<?php

use Illuminate\Database\Seeder;
use App\TransactionType;

class transaction_types_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $t_type = new TransactionType();

        $t_type->transaction_type_name = 'Add';
        $t_type->save();
        $t_type1 = new TransactionType();
        $t_type1->transaction_type_name = 'Subtract';
        $t_type1->save();
    }
}
