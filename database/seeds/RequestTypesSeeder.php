<?php

use Illuminate\Database\Seeder;
use App\RequestType;

class RequestTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $query_bill = new RequestType();
        $query_bill->request_type_name = 'QUERYBILL';
        $query_bill->request_type_code = 'QUERYBILL';
        $query_bill->request_type_status = '1';
        $query_bill->save();

        $compliance = new RequestType();
        $compliance->request_type_name = 'COMPLIANCE';
        $compliance->request_type_code = 'COMPLIANCE';
        $compliance->request_type_status = '1';
        $compliance->save();

        $validation = new RequestType();
        $validation->request_type_name = 'VALIDATION';
        $validation->request_type_code = 'VALIDATION';
        $validation->request_type_status = '1';
        $validation->save();

        $paybill = new RequestType();
        $paybill->request_type_name = 'PAYBILL';
        $paybill->request_type_code = 'PB';
        $paybill->request_type_status = '1';
        $paybill->save();

        $buy_service = new RequestType();
        $buy_service->request_type_name = 'BUYSERVICE';
        $buy_service->request_type_code = 'BS';
        $buy_service->request_type_status = '1';
        $buy_service->save();

        $inquire = new RequestType();
        $inquire->request_type_name = 'INQUIRE';
        $inquire->request_type_code = 'IQ';
        $inquire->request_type_status = '1';
        $inquire->save();
    }
}
