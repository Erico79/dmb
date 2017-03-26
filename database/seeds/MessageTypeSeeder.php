<?php

use Illuminate\Database\Seeder;
use App\MessageType;

class MessageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $em = new MessageType;
        $em->message_type_name = 'Email';
        $em->message_type_code = 'EMAIL';
        $em->save();

        $sms = new MessageType;
        $sms->message_type_name = 'sms';
        $sms->message_type_code = 'SMS';
        $sms->save();

        $ps = new MessageType;
        $ps->message_type_name = 'Push Notifications';
        $ps->message_type_code = 'PUSH';
        $ps->save();
    }
}
