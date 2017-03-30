<?php

namespace App\Http\Controllers;

use App\Role;
use App\Route;
use App\Sys_action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\DB;
use App\User;

use App\Http\Requests;

class SysActionsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function user(){
        $user = Auth::user;

    }
    public function index(){
        $action = Sys_action::all();

        return view('system.sys_action', [
            'sys-actions' => $action
        ]);
    }

    public function loadActions(){
        return Datatables::queryBuilder(DB::table('sys_actions_view'))->editColumn('action_status',
                '@if($action_status)
                    Active
                @else
                    Inactive
                @endif')->make(true);
    }

    public function getChildRoutes(){
        $child_routes = Route::whereNotNull('parent_route')->get();
        $return = [];
        if (count($child_routes)){
            foreach ($child_routes as $child){
                $return[] = [
                    'id' => $child->id,
                    'route_name' => $child->route_name
                ];
            }
        }
        return Response::json($return);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'action_description' => 'required',
            'action_name' => 'required',
            'action_type' => 'required',
            'action_category' => 'required',
            'action_status' => 'required'
        ]);

        //var_dump('after validation');exit;

        $return = [];
        if($validator->fails()){
            $return = [
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ];
        }else{

            $user = Auth::user();
            //var_dump($user);exit;
            $cuser = $user->masterfile_id;

            // generate the action code
            $action_name = $request->action_name;
            $croute_id = $request->route_id;
            $parent_route_id = Route::find($croute_id)->parent_route;
            $parent_name = Route::find($parent_route_id)->route_name;
            $route_name = Route::find($croute_id)->route_name;
            //var_dump($route_name);exit;

            //this will limit the action code to four characters
            $parent_name = substr($parent_name, 0, 4);
            $route_name= substr($route_name, 0, 4);
            $action_name  = substr($action_name, 0, 3);
            $action_code = $parent_name.'_'.$route_name.'_'.$action_name;

            //var_dump('after substr');exit;
            // check if the action code exists
            $code_count = Sys_action::where('action_code', $action_code)->count();
            //var_dump($code_count);exit;
            if(!$code_count) {
                // add action
                $action = new Sys_action();
                $action->action_description = $request->action_description;
                $action->action_name = $request->action_name;
                $action->route_id = $request->route_id;
                $action->action_status = $request->action_status;
                $action->user_mfid = $user->masterfile_id;
                $action->action_class = $request->action_class;
                $action->attributes = $request->action_attributes;
                $action->icon = $request->icon;
                $action->action_type = $request->action_type;
                $action->action_category = $request->action_category;
                $action->save();
                $action_id = $action->id;
                //var_dump($action_id);exit;
                // update the action code
                Sys_action::where('id', $action_id)
                    ->update([
                        'action_code' => $action_code.'_'.$action_id
                    ]);

                $return = ['success' => true];
            }else{
                $return = ['success' => false];
            }
        }
        return Response::json($return);
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'action_description' => 'required',
            'action_status' => 'required'
        ]);

        $return = [];
        if($validator->fails()){
            $return = [
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ];
        }else{
            // edit action
            $user = Auth::user();
            $cuser = $user->masterfile_id;
//            var_dump($request->action_description);exit;
//            var_dump($user);exit;
            Sys_action::where('id', $request->id)
                ->update([
                    'action_description' => $request->action_description,
                    'action_name' => $request->action_name,
                    'action_class' => $request->action_class,
                    'attributes' => $request->action_attributes,
                    'icon' => $request->icon,
                    'action_type' => $request->action_type,
                    'action_category' => $request->action_category,
                    'route_id' => $request->route_id,
                    'user_mfid' => $user->masterfile_id,
                    'action_status' => $request->action_status
                ]);

            $return = [ 'success' => true ];
        }
        return Response::json($return);
    }

    public function destroy(Request $request){
        if(Sys_action::destroy($request->ids)){
            $return = [ 'success' => true ];
        }else{
            $return = [ 'success' => false ];
        }
        return Response::json($return);
    }

    public function getAction(Request $request){
         $id = $request->id;
        $action = Sys_action::find($id);
        return Response::json($action);
    }

    public function getParent(Request $request){
        $route_id = $request->parent_route;
        $parent_route = Route::find($route_id);
        return Response::json($parent_route);
    }
}
