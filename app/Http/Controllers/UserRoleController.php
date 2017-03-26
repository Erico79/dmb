<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Role;
use App\Route;
use App\Sys_action;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Facades\Datatables;

class UserRoleController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index(){
        return view('users.roles');
    }

    public function store(Request $request){
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'role_name' => 'required|unique:roles',
            'role_code' => 'required|unique:roles',
            'role_status' => 'required'
        ]);

        if($validator->fails()){
            return Response::json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }else{
            $role = new Role();
            $role->role_name = $request->role_name;
            $role->role_code = $request->role_code;
            $role->role_status = $request->role_status;
            $role->user_mfid = $user->masterfile_id;
            $role->save();

            return Response::json([
                'success' => true
            ]);
        }
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'role_name' => 'required|unique:roles,role_name,'.$request->edit_id,
            'role_code' => 'required|unique:roles,role_name,'.$request->edit_id,
            'role_status' => 'required'
        ]);

        if($validator->fails()){
            return Response::json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }else{
            Role::where('id', $request->edit_id)
                ->update([
                    'role_name' => $request->role_name,
                    'role_code' => $request->role_code,
                    'role_status' => $request->role_status
                ]);

            return Response::json(['success' => true]);
        }
    }

    public function loadRoles(){
        $roles = Role::query();
        return Datatables::of($roles)
            ->editColumn('role_status', '
            @if($role_status)
                Active
            @else
                Inactive
            @endif
            ')
            ->editColumn('user_mfid',
                '<?php 
                    $mf = \App\Masterfile::find($user_mfid);
                    echo $mf->surname." ".$mf->firstname;
                ?>'
            )
            ->addColumn('manage', function($role){
                return '<button class="btn btn-default btn-mini manage-btn" role-id="'.$role->id.'"><i class="icon-paper-clip"></i> Manage</button>';
            })
            ->make(true);
    }

    public function getRole(Request $request){
        $id = $request->id;

        $role = Role::find($id);
        return Response::json($role);
    }

    public function destroy(Request $request){
        if(Role::destroy($request->ids)){
            return Response::json(['success' => true]);
        }else{
            return Response::json(['success' => true]);
        }
    }

    public function getRoutes($parent_id = NULL){
        $routes = (is_null($parent_id) || empty($parent_id)) ? Route::whereNull('parent_route')->get() : Route::where('parent_route', $parent_id)->get();

        if(count($routes)){
            echo '<ol class="dd-list">';

            foreach ($routes as $route) {
                echo '<li class="dd-item dd3-item" data-id="' . $route->id . '">';
                echo '<div class="dd3-content">'.$route->route_name;
                echo '<div class="dd-handle dd3-handle"> Drag</div>';
                echo '<div class="pull-right">';
                echo '<div class="checkbox no-margin">';

                if(!is_null($parent_id)) {
                    echo '<label><input type="checkbox" class="checkbox style-0" value="' . $route->id . '"/>';
                    echo '<span class="font-xs" menu-id="' . $route->id . '">';
                    echo '<a href="#load_actions" class="load-actions-link" data-toggle="modal" item-id="' . $route->id . '">';
                    echo '<i class="fa fa-clip"></i> Actions </a>';
                    echo '</span>';
                    echo '</label>';
                }

                echo '</div>';
                echo '</div>';
                echo '</div>';

                $this->getRoutes($route->id);
                echo '</li>';
            }

            echo '</ol>';
        }
    }

    public function attachToRole(Request $request){
        $role = Role::find($request->role);

        // a little bit of validation
        $exists = DB::table('role_route')->where([
            'route_id' => $request->route,
            'role_id' => $request->role
        ])->count();

        if($exists){
            return Response::json([
                'success' => false,
                'message' => 'Route is already attached!'
            ]);
        }else{
            $role->routes()->attach($request->route);
            return Response::json(['success' => true]);
        }
    }

    public function detachFromRole(Request $request){
        $role = Role::find($request->role);
        $role->routes()->detach($request->route);
        return Response::json(['success' => true]);
    }

    public function getRoleRoutes(Request $request){
        $role_id = $request->role_id;
        $allocated = DB::table('role_route')
            ->select('route_id')
            ->where('role_id', $role_id)
            ->get();
        return Response::json($allocated);
    }

    public function loadRouteActions(Request $request){
        $actions = Sys_action::where('route_id', $request->id)->get();

        $return = [];
        if (count($actions)){
            foreach ($actions as $action){
                // check if action is allocated
                $attached = DB::table('role_sys_action')
                    ->where([
                        'role_id' => $request->role_id,
                        'sys_action_id' => $action->id
                    ])
                    ->count();

                $return[] = array(
                    'id' => $action->id,
                    'action_name' => $action->action_name,
                    'action_code' => $action->action_code,
                    'action_status' => $action->action_status,
                    'route_id' => $action->route_id,
                    'attached' => ($attached) ? true : false
                );
            }
        }

        return Response::json($return);
    }

    public function attachAction(Request $request){
        $role = Role::find($request->role_id);
        $role->actions()->attach($request->action_id);
        return Response::json(['success' => true]);
    }

    public function detachAction(Request $request){
        $role = Role::find($request->role_id);
        $role->actions()->detach($request->action_id);
        return Response::json(['success' => true]);
    }
}