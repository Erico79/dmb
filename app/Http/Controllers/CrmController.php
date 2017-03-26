<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Masterfile;

class CrmController extends Controller
{
    public function getAllCustomers(){
        $customers = Masterfile::where('b_role', '=', 'Client')->get();
        return view('crm.all_customers', array(
            'customers' => $customers
        ));
    }

    public function getAllStaffs(){
        $staffs = Masterfile::where('b_role', '=', 'Staff')->get();
        return view('crm.all_staff', array(
            'staffs' => $staffs
        ));
    }

    public function getAllSuppliers(){
        $suppliers = Masterfile::where('b_role', '=', 'Supplier')->get();
        return view('crm.all_suppliers', array(
            'suppliers' => $suppliers
        ));
    }
}
