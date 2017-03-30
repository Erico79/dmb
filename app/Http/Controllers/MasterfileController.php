<?php

namespace App\Http\Controllers;

use App\Customers;
use App\Document;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Masterfile;
use App\Address;
use App\Role;
use App\CustomerType;
use App\AddressType;
use App\County;
use App\User;
use App\AllMfs;
use App\Item;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use Yajra\Datatables\Facades\Datatables;

class MasterfileController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        // fetch data
        $roles = Role::all();
        $customers = CustomerType::all();
        $addresses = AddressType::all();
        $counties = County::all();

        return view('masterfile.index', array(
            'customers' => $customers,
            'roles' => $roles,
            'addresses' => $addresses,
            'counties' => $counties,
        ));
    }

    public function allMfs(){
        $mfs = Masterfile::where([
            ['status', '=', 1],
            ['b_role', '=', 'Customer'],
        ])
        ->orWhere('b_role', 'Supplier')
        ->get();
        return view('masterfile.all_mfs')->withMfs($mfs);
    }

    public function loadDelMfs(){
         $del_mfs = Masterfile::where('status', '=', 'FALSE')->get();
        return view('masterfile.deleted_mfs', array(
            'del_mfs' => $del_mfs
        ));
    }

    public function addMf(Request $request)
    {
        // validate
        $this->validate($request, array(
            'surname' => 'required|max:255',
            'firstname' => 'required',
            'id_passport' => 'required|unique:masterfiles',
            'gender' => 'required',
            'email' => 'required|unique:masterfiles',
            'b_role' => 'required',
//            'user_role' => 'required',
            'customer_type_name' => 'required',
            'county' => 'required',
            'town' => 'required',
            'phone' => 'required',
            'postal_address' => 'required',
            'postal_code' => 'required',
            'address_type_name' => 'required'
        ));

        switch ($request->b_role) {
                case 'Administrator':
                    $this->addAdmin();
                    break;

                case 'Staff':
                    $this->addStaff();
                    break;

                case 'Customer':
                    $this->addClient($request);
                    break;

                case 'Supplier':
                    $this->addSupplier();
                    break;
            }
        return redirect('masterfile');
    }

    public function addAdmin(){
        DB::transaction(function(){
            // upload image if exists
            $path = '';
            if(Input::hasFile('image_path')){
                $prefix = uniqid();
                $image = Input::file('image_path');
                $filename = $image->getClientOriginalName();
                $new_name = $prefix.$filename;

                if($image->isValid()) {
                    $image->move('uploads/images', $new_name);
                    $path = 'uploads/images/'.$new_name;
                }
            }
            //var_dump($path);exit;

            // add to db
            $mf = Masterfile::create(array(
                'surname' => Input::get('surname'),
                'firstname' => Input::get('firstname'),
                'middlename' => Input::get('middlename'),
                'email' => Input::get('email'),
                'id_passport' => Input::get('id_passport'),
                'b_role' => Input::get('b_role'),
                'gender' => Input::get('gender'),
                'user_role' => Input::get('user_role'),
                'reg_date' => Input::get('reg_date'),
                'customer_type_name' => Input::get('customer_type_name'),
                'image_path' => $path,
                'status' => 1
            ));
            //var_dump($mf);exit;
            $mf->save();
            $mf_id = $mf->id;

            // add address details
            $address = Address::create(array(
                'county' => Input::get('county'),
                'town' => Input::get('town'),
                'masterfile_id' => $mf_id,
                'ward' => Input::get('ward'),
                'street' => Input::get('street'),
                'building' => Input::get('building'),
                'phone' => Input::get('phone'),
                'postal_address' => Input::get('postal_address'),
                'postal_code' => Input::get('postal_code'),
                'address_type_name' => Input::get('address_type_name')
            ));
            $address->save();

            //create

            // create user login account
            $password = sha1(123456);
            $login = User::create(array (
                'masterfile_id' => $mf_id,
                'email' => Input::get('email'),
                'password' => $password
            ));
//            var_dump($login);exit;
            $login->save();
        });

        Session::flash('success', 'Administrator '.$_POST['surname'].' '.$_POST['firstname'].' has been added');
    }

    public function addStaff(){
        DB::transaction(function(){
            // upload image if exists
            $path = '';
            if(Input::hasFile('image_path')){
                $prefix = uniqid();
                $image = Input::file('image_path');
                $filename = $image->getClientOriginalName();
                $new_name = $prefix.$filename;

                if($image->isValid()) {
                    $image->move('uploads/images', $new_name);
                    $path = 'uploads/images/'.$new_name;
                }
            }
            //var_dump($path);exit;

            // add to db
            $mf = Masterfile::create(array(
                'surname' => Input::get('surname'),
                'firstname' => Input::get('firstname'),
                'middlename' => Input::get('middlename'),
                'email' => Input::get('email'),
                'id_passport' => Input::get('id_passport'),
                'b_role' => Input::get('b_role'),
                'gender' => Input::get('gender'),
                'user_role' => Input::get('user_role'),
                'reg_date' => Input::get('reg_date'),
                'customer_type_name' => Input::get('customer_type_name'),
                'image_path' => $path,
                'status' => 1
            ));

            $mf->save();
            $mf_id = $mf->id;

            // add address details
            $address = Address::create(array(
                'county' => Input::get('county'),
                'town' => Input::get('town'),
                'masterfile_id' => $mf_id,
                'ward' => Input::get('ward'),
                'street' => Input::get('street'),
                'building' => Input::get('building'),
                'phone' => Input::get('phone'),
                'postal_address' => Input::get('postal_address'),
                'postal_code' => Input::get('postal_code'),
                'address_type_name' => Input::get('address_type_name')
            ));
            $address->save();

            //create

            // create user login account
            $password = sha1(123456);
            $full_name = $mf->surname.' '.$mf->firstname;
            //$token = rememberToken();
            $login = User::create(array (
                'masterfile_id' => $mf_id,
                'email' => Input::get('email'),
                'password' => $password,
                'name' => $full_name
                //'remember_token' => $token
            ));
            //print_r($login);exit;
            $login->save();
        });

        Session::flash('success', 'Staff '.$_POST['surname'].' '.$_POST['firstname'].' has been added');
    }

    public function addClient(){
        DB::transaction(function(){
            // upload image if exists
            $path = '';
            if(Input::hasFile('image_path')){
                $prefix = uniqid();
                $image = Input::file('image_path');
                $filename = $image->getClientOriginalName();
                $new_name = $prefix.$filename;

                if($image->isValid()) {
                    $image->move('uploads/images', $new_name);
                    $path = 'uploads/images/'.$new_name;
                }
            }

            // add to db
            $mf = Masterfile::create(array(
                'surname' => Input::get('surname'),
                'firstname' => Input::get('firstname'),
                'middlename' => Input::get('middlename'),
                'email' => Input::get('email'),
                'id_passport' => Input::get('id_passport'),
                'b_role' => Input::get('b_role'),
                'gender' => Input::get('gender'),
//                'user_role' => Input::get('user_role'),
                'reg_date' => Input::get('reg_date'),
                'customer_type_name' => Input::get('customer_type_name'),
                'image_path' => $path,
                'status' => 1

            ));
            $mf_id = $mf->id;

            // add address details
            $address = Address::create(array(
                'county' => Input::get('county'),
                'town' => Input::get('town'),
                'masterfile_id' => $mf_id,
                'ward' => Input::get('ward'),
                'street' => Input::get('street'),
                'building' => Input::get('building'),
                'phone' => Input::get('phone'),
                'postal_address' => Input::get('postal_address'),
                'postal_code' => Input::get('postal_code'),
                'address_type_name' => Input::get('address_type_name')
            ));
            $address->save();
        });

        Session::flash('success', 'Client '.$_POST['surname'].' '.$_POST['firstname'].' has been added!');
    }

    public function addSupplier(){
        DB::transaction(function($path){
            // upload image if exists
            $path = '';
            if(Input::hasFile('image_path')){
                $prefix = uniqid();
                $image = Input::file('image_path');
                $filename = $image->getClientOriginalName();
                $new_name = $prefix.$filename;

                if($image->isValid()) {
                    $image->move('uploads/images', $new_name);
                    $path = 'uploads/images/'.$new_name;
                }
            }

            // add to db
            $mf = Masterfile::create(array(
                'surname' => Input::get('surname'),
                'firstname' => Input::get('firstname'),
                'middlename' => Input::get('middlename'),
                'email' => Input::get('email'),
                'id_passport' => Input::get('id_passport'),
                'b_role' => Input::get('b_role'),
                'gender' => Input::get('gender'),
                'reg_date' => Input::get('reg_date'),
                'customer_type_name' => Input::get('customer_type_name'),
                'image_path' => $path,
                'status' => 1
            ));
            $mf_id = $mf->id;

            // add address details
            $address = Address::create(array(
                'county' => Input::get('county'),
                'town' => Input::get('town'),
                'masterfile_id' => $mf_id,
                'ward' => Input::get('ward'),
                'street' => Input::get('street'),
                'building' => Input::get('building'),
                'phone' => Input::get('phone'),
                'postal_address' => Input::get('postal_address'),
                'postal_code' => Input::get('postal_code'),
                'address_type_name' => Input::get('address_type_name')
            ));
        });

        Session::flash('success', 'Supplier '.$_POST['surname'].' '.$_POST['firstname'].' has been added');
    }

    public function updateMf(Request $request, $id){
        // validate
        $this->validate($request, array(
            'surname' => 'required',
            'firstname' => 'required',
//            'id_passport' => 'required|unique:masterfiles,id_passport,'.$id,
//            'email' => 'required|unique:masterfiles,email,'.$id,
            'reg_date' => 'required|date',
//            'user_role' => 'required',
            'customer_type_name' => 'required'
        ));


            // upload image if exists
            $path = '';
            if(Input::hasFile('image_path')){
                $prefix = uniqid();
                $image = Input::file('image_path');
                $filename = $image->getClientOriginalName();
                $new_name = $prefix.$filename;

                if($image->isValid()) {
                    $image->move('uploads/images', $new_name);
                    $path = 'uploads/images/'.$new_name;
                }
            }
            // var_dump($path);exit;

            // update db record
            Masterfile::where('id', $id)
                ->update(array(
                    'b_role' => $request->b_role,
                    'surname' => $request->surname,
                    'firstname' => $request->firstname,
                    'middlename' => $request->middlename,
                    'email' => $request->email,
                    'gender' => $request->gender,
                    'image_path' => $path,
                    'id_passport' => $request->id_passport,
                    'customer_type_name' => $request->customer_type_name,
//                    'user_role' => $request->user_role
                ));


        $request->session()->flash('success', 'Masterfile Channel has been updated');
        return redirect('edit_mf/'.$id);
    }

    public function softDeleteMf(Request $request, $id){
        // update db record
        $mf = Masterfile::find($id);
        $mf->status = 0;
        $mf->save();
        Session::flash('success', 'Masterfile record has been deleted');
        return redirect('all_mfs');
    }

    public function refreshMf(Request $request, $id){
        return redirect('edit_mf/'.$id);
    }

    public function restoreMf(Request $request, $id){
        $mf = Masterfile::find($id);
        $mf->status = 1;
        $mf->save();
        Session::flash('success', 'Masterfile record has been RESTORED!');
        Return redirect('deleted_mfs');
    }

    public function destroy(Request $request, $id){
        //echo $id;die;
        Masterfile::destroy($id);
            Session::flash('success', 'Masterfile record has been PERMANENTLY DELETED!');
            return redirect('deleted_mfs');

    }

    public function getMf(Request $request){
        $mf_id = $request->id;
        $mf = Masterfile::find($mf_id);

        $roles = Role::all();
        $cts = CustomerType::all();
        return view('masterfile.edit_mf', array(
            'mf' => $mf,
            'roles' => $roles,
            'cts' => $cts,
            'mf_id' => $mf_id
        ));
    }

    public function mfProfile(Request $request){
        $mf_id = $request->id;
        $mf = Masterfile::find($mf_id);
        return view('masterfile.mf_profile', array(
            'mf' => $mf
        ));
    }

    public function getMfProfile(Request $request){
        // get mf_id
        $mf_id = $request->id;
        $mf = Masterfile::find($mf_id);
        // get mf address info
        $addresses = Address::where('masterfile_id', $mf_id)->get();
        $counties = County::all();
        $addr_types = AddressType::all();
        $addr = AddressType::all();
        $items = Item::where('masterfile_id', $mf_id)->get();
        $tokens = DB::table('token_journal')->where('token_mf_id', '=', $mf_id)->get();

        return view('masterfile.mf_profile')->with(array(
            'mf' => $mf,
            'addresses'=>$addresses,
            'counties' => $counties,
            'addr_types' => $addr_types,
            'addr' => $addr,
            'items' => $items,
            'tokens' => $tokens
        ));
    }

    public function addAddress(Request $request){
        $this->validate($request, array(
            'county'=> 'required',
            'town'=> 'required',
            'address_type_name'=> 'required',
            'postal_address'=> 'required',
            'postal_code'=> 'required',
            'phone'=> 'required'
        ));

        $address = new address();

        $address->masterfile_id = $request->masterfile_id;
        $address->county = $request->county;
        $address->town = $request->town;
        $address->address_type_name =$request->address_type_name;
        $address->postal_address =$request->postal_address;
        $address->postal_code =$request->postal_code;
        $address->ward =$request->ward;
        $address->street =$request->street;
        $address->building =$request->building;
        $address->phone =$request->phone;

        $address->save();

        $request->session()->flash('success', 'New Address has been added');
        return redirect('mf-profile/'.$request->masterfile_id);

    }

    public function getAddressData(Request $request){
        $id = $request->id;
        $address = Address::find($id);
        return \Illuminate\Support\Facades\Response::json($address);
    }

    public function updateAddress(Request $request, $id){
        //var_dump($_POST);
        $address = Address::find($id);
        if($address->county != $request->input('county')) {
            $this->validate($request, array(
                'county' => 'required',
                'town' => 'required',
                'postal_address' => 'required',
                'address_type_name' => 'required',
                'postal_code' => 'required',
                'phone' => 'required'
            ));
        }else{
            $this->validate($request, array(
                'county' => 'required',
                'town' => 'required',
                'postal_address' => 'required',
                'address_type_name' => 'required',
                'postal_code' => 'required',
                'phone' => 'required'
            ));
        }
        $address->county = $request->input('county');
        $address->town = $request->input('town');
        $address->postal_address =$request->input('postal_address');
        $address->postal_code =$request->input('postal_code');
        $address->ward =$request->input('ward');
        $address->street =$request->input('street');
        $address->building =$request->input('building');
        $address->phone =$request->input('phone');

        $address->save();

        Session::flash('success','Address Details Has Been Updated');
        return redirect('mf-profile/'.+$request->masterfile_id);
    }

    public function deleteAddress(Request $request, $id){
        //var_dump($_POST);exit;
        if(Address::destroy($id)){
            Session::flash('success','Address Details has been deleted');
            return redirect('mf-profile/'.+$request->masterfile_id);
//            return redirect('mf-profile/'.+$request->masterfile_id)->with('status', 'Address Details has been deleted!');
        }
    }

    public function myBids(Request $request){
        return Datatables::queryBuilder(DB::table('mybids')->where('mf_id', $request->id))->make(true);
    }

    public function myPurchase(Request $request){
        return Datatables::queryBuilder(DB::table('mypurchases')->where('win_mf_id', $request->id))->make(true);
    }

    public function allStaff(){
        $staff = DB::table('all_masterfile')->where('b_role', '=', 'Staff')->get();
        return view('crm.all_staff')->with(array('staff' => $staff ));
    }

    public function loadStaff(){
        $staff = DB::table('all_masterfile')->where('b_role', '=', 'Staff')->get();
        return Datatables::of($staff)->make(true);
    }

    public function allCustomers(){
        $client = DB::table('all_masterfile')->where('b_role', '=', 'Customer')->get();
        return view('crm.all_customers')->with(array('client' => $client ));
    }

    public function loadCustomers(){
        $clients = DB::table('all_masterfile')->where('b_role', '=', 'Customer')->get();
        return Datatables::of($clients)
            ->addColumn('profile', function ($client){
                return '<a href="'.url("client/show/".$client->id).'" class="btn btn-mini btn-info"><i class="icon-eye-open"></i> Profile</a>';
            })
            ->make(true);
    }

    public function allSuppliers(){
        $supplier = DB::table('all_masterfile')->where('b_role', '=', 'Supplier')->get();
        return view('crm.all_suppliers')->with(array('supplier' => $supplier ));
    }

    public function loadSuppliers(){
        $suppliers = DB::table('all_masterfile')->where('b_role', '=', 'Supplier')->get();
        return Datatables::of($suppliers)
            ->addColumn('profile', function ($supplier){
                return '<a href="'.url("supplier/show/".$supplier->id).'" class="btn btn-mini btn-info"><i class="icon-eye-open"></i> Profile</a>';
            })
            ->make(true);
    }

    public function getMfById($mf_id){
        return Masterfile::find($mf_id);
    }

    public function showClient($id){
        $customer = Masterfile::find($id);
        $docs = Document::where('customer_mfid', $id)->get();

        return view('crm.client-prof')->with([
            'customer' => $customer,
            'docs' => $docs
        ]);
    }

    public function showSupplier($id){
        $supplier = Masterfile::find($id);
        $docs = Document::where('supplier_mfid', $id)->get();

        return view('crm.supplier-prof')->with([
            'supplier' => $supplier,
            'docs' => $docs
        ]);
    }
}
