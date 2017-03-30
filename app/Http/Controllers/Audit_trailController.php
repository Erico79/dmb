<?php

namespace App\Http\Controllers;

use App\Audit_trail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\DB;
use App\User;

use App\Http\Requests;

class Audit_trailController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('validateroutes');
    }

    public function index(){

        $audit = Audit_trail::all();

        return view('user_management.audit_trail', [
            'audit_trails' => $audit
        ]);
    }

    public function loadAudit(){
        return Datatables::queryBuilder(DB::table('audit_view'))->make(true);
    }

    public function getAudit(Request $request){
        $id = $request->id;
        $audit = Audit_trail::find($id);
        return Response::json($audit);
    }
}
