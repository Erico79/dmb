<?php

namespace App\Http\Controllers;

use App\Masterfile;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function allSuppliers(){
        return Masterfile::where('b_role', 'Supplier')->get();
    }
}
