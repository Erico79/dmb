<?php

namespace App\Http\Controllers;

use App\User;
use App\Message;
use App\MessageType;
use App\MessageContent;
use App\Masterfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Http\Request;

class Manage_userController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('validateroutes');
    }

    public function index(){
        $users = User::all();

        return view('users.all_users', array(
            'users' => $users
        ));
    }

    public function loadAllusers(){
        $users =DB::table('users_view');
        return Datatables::queryBuilder($users)
            ->editColumn('status',
            '@if($status)
                  <label class="label label-success"> Active</label>
                @else
                   <label class="label label-inverse"> Blocked</label>
                @endif')
            ->addColumn('manage', function ($users){

                return ($users->status)? '<button class="btn btn-mini btn-warning" id="block" user-id="'.$users->id.'"><i class="icon-user-md"></i> Deactivate User</button>'
                    :'<button class="btn btn-mini btn-success" id="unblock" user-id="'.$users->id.'"><i class="icon-user-md"></i> Activate User</button>';

            })
            ->addColumn('profile', function ($users){
                return '<a href="user_profile/'.$users->id.'" class="btn btn-xs btn-info"><i class="icon-user"></i> View Profile</a>';
            })
            ->make(true);
    }

    public function getUserData(Request $request){
        $id = $request->id;
        $user_data = User::find($id);
        return Response::json($user_data);
    }

    public function destroy(Request $request){
        if(User::destroy($request->ids)){
            $return = [ 'success' => true ];
        }else{
            $return = [ 'success' => false ];
        }
        return Response::json($return);
    }

    public function updateUser(Request $request ){
        $validator = Validator::make($request->all(), [

        ]);

        $return = [];
        if($validator->fails()){
            $return = [
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ];
        }else {

            DB::transaction(function(){
            //generate random number as password
            $pass = str_random(8);
            //hash the password
            $password = bcrypt($pass);
                $id = Input::get('id');

            User::where('id', $id)
                ->update(array(
                    'password' => $password
                ));
            $user = Auth::user();
            $suser = $user->masterfile_id;
            // message type
            $messcode = 'EMAIL';
            $mest = MessageType::where('message_type_code', $messcode)->first();
            $mtid = $mest->id;
            //content type
            $content = 'AUTH';
            $mescont = MessageContent::where('content_name', $content)->first();
            $mct = $mescont->id;
            $status = '0';
            $uid = Input::get('id');
            $user_updata = User::find($uid);
            $cuser = $user_updata->masterfile_id;
            $name = $user_updata->name;
            $email = $user_updata->email;
            $subject = 'New Login Credential';
            $message = "Dear '$name',\r\n";
            $message .= "Your New Login Credentails are as below:\r\n";
            $message .= "Your Username: '$email'\r\n";
            $message .= "Your Password: '$pass'\r\n\r\n";
            $message .= "Thanks,\r\n";
            $message .= "Oriems Madeals";
            $reciever = '[' . $cuser . ']';
            $messtype = '[' . $mtid . ']';
            $sender = $suser;

            // add to db
            $action = Message::create(array(
                'body' => $message,
                'sender' => $sender,
                'recipients' => $reciever,
                'message_status' => $status,
                'message_type' => $messtype,
                'content_type' => $mct,
                'subject' => $subject

            ));
                $action->save();


            });
            $return = [ 'success' => true ];
        }

        return Response::json($return);
    }

    public function blockUser(Request $request){
        $validator = Validator::make($request->all(), [

        ]);

        $return = [];
        if($validator->fails()){
            $return = [
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ];
        }else{
            // block User account
            User::where('id', $request->id)
                ->update([
                    'status' => $request->status
                ]);

            $return = [ 'success' => true ];
        }
        return Response::json($return);
    }

    public function unblockUser(Request $request){
        $validator = Validator::make($request->all(), [

        ]);

        $return = [];
        if($validator->fails()){
            $return = [
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ];
        }else{
            // block User account
            User::where('id', $request->id)
                ->update([
                    'status' => $request->status
                ]);

            $return = [ 'success' => true ];
        }
        return Response::json($return);
    }

    public function getUsProfile(Request $request){
        // get user id
        $us_id = $request->id;
        $us = User::find($us_id);
        // get user mf details
        $mf = Masterfile::find($us->masterfile_id);
        // get user Audit Trail Record
        $at = DB::table('audit_view')->where('mf_id', $us->masterfile_id)->get();
        return view('users.user_profile', array(
            'us' => $us,
            'mf'=>$mf,
            'at' => $at
        ));
    }
    
    public function getUsAudit(Request $request){
        $us_id = $request->id;
        $us = User::find($us_id);
        return Datatables::queryBuilder(DB::table('audit_view')->where('mf_id', $us->masterfile_id))->make(true);
    }
    
    public function changePassword(Request $request){
        // check for existing password
        $old_pass = $request->oldpassword;
        $mf_id = $request->id;
        
    }

    public function getProfile(){
        // get user id
        $user = Auth::user();
        $us_id = $user->id;
        $us = User::find($us_id);
//        var_dump($us);
        // get user mf details
        $mf = Masterfile::find($us->masterfile_id);
        // get user Audit Trail Record
        $at = DB::table('audit_view')->where('mf_id', $us->masterfile_id)->get();
        return view('users.profile', array(
            'us' => $us,
            'mf'=>$mf,
            'at' => $at
        ));
    }

    public function getAudit(Request $request){
        $us_id = $request->id;
        $us = User::find($us_id);
        return Datatables::queryBuilder(DB::table('audit_view')->where('mf_id', $us->masterfile_id))->make(true);
    }
}
