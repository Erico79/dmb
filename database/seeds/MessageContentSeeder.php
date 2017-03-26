<?php

use Illuminate\Database\Seeder;
use App\MessageContent;

class MessageContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $auth = new MessageContent;
        $auth->content_name = 'AUTH';
        $auth->save();

        $mess = new MessageContent;
        $mess->content_name = 'MESS';
        $mess->save();

    }
}
