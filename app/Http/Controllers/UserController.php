<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index(){
        $users = User::all();

        return view('users.index', array(
            'users' => $users
        ));
    }

//    public function update(Request $request){
//        $this->validate($request, array(
//            'status' => 'required'
//        ));
//
//        User::where('id', $request->edit_id)
//            ->update(array(
//                'status' => $request->status
//            ));
//
//        $request->session()->flash('status', 'User Details have been updated');
//        return redirect('users');
//    }

//    public function destroy(Request $request){
//        if(User::destroy($request->delete_id)){
//            $request->session()->flash('status', 'User has been permanently removed from the system');
//            return redirect('users');
//        }
//    }
}
