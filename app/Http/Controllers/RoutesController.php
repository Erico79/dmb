<?php

namespace App\Http\Controllers;

use App\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Facades\Datatables;

use App\Http\Requests;

class RoutesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('validateroutes');
    }

    public function index(){
        $parents = Route::whereNull('parent_route')->get();

        return view('system.routes', [
            'parents' => $parents
        ]);
    }

    public function loadRoutes(){
        return Datatables::of(Route::query())
            ->editColumn('route_status',
                '@if($route_status)
                    Active 
                @else
                    Inactive
                @endif')
            ->editColumn('parent_route',
                '@if(!empty($parent_route))
                    {{ App\Route::find($parent_route)->route_name }}
                @endif')
            ->make(true);
    }

    public function getRoutes(){
        $proutes = Route::whereNull('parent_route')->get();
        $return = [];
        if (count($proutes)){
            foreach ($proutes as $route){
                $return[] = [
                    'id' => $route->id,
                    'route_name' => $route->route_name
                ];
            }
        }
        return Response::json($return);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'route_name' => 'required|unique:routes',
            'route_status' => 'required'
        ]);

        $return = [];
        if($validator->fails()){
            $return = [
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ];
        }else{
            // add route
            $route = new Route();
            $route->route_name = $request->route_name;
            $route->url = $request->url;
            $route->parent_route = (!empty($request->parent)) ? $request->parent : NULL;
            $route->route_status = $request->route_status;
            $route->save();

            $return = [ 'success' => true ];
        }
        return Response::json($return);
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'route_name' => 'required|unique:routes,route_name,'.$request->id,
            'route_status' => 'required'
        ]);

        $return = [];
        if($validator->fails()){
            $return = [
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ];
        }else{
            // add route
            Route::where('id', $request->id)
                ->update([
                    'route_name' => $request->route_name,
                    'url' => $request->url,
                    'parent_route' => (!empty($request->parent)) ? $request->parent : NULL,
                    'route_status' => $request->route_status
                ]);

            $return = [ 'success' => true ];
        }
        return Response::json($return);
    }

    public function destroy(Request $request){
        if(Route::destroy($request->ids)){
            $return = [ 'success' => true ];
        }else{
            $return = [ 'success' => false ];
        }
        return Response::json($return);
    }

    public function getRoute(Request $request){
        $id = $request->id;
        $route = Route::find($id);
        return Response::json($route);
    }
}
