<?php

namespace App\Http\Controllers;

use App\Category;
use App\SubCategory;
use App\Warehouse;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class InventoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('validateroutes');
    }

    public function getIndex(){
        return view('inventory.index');
    }

    public function getCategories(){
        $categories = Category::all();
        return view('inventory.categories')->withCategories($categories);
    }

    public function getCategoryData($id){
        $ailments = Category::find($id);
        return json_encode($ailments);
    }


    public function addCategory(Request $request){
        $this->validate($request, array(
            'category_name'=> 'required|unique:categories,category_name',
            'category_code'=>'required|unique:categories,category_code',
            'category_status'=>'required'
        ));

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->category_code = $request->category_code;
        $category->category_status =$request->category_status;
        $category->parent_category = (!empty($request->parent_category)) ? $request->parent_category : NULL;
        $category->save();

        Session::flash('success','The category has been added');
        return redirect()->route('category.index');

    }

    public function updateCategory(Request $request ,$id){
        //update category details
        $category = Category::find($id);
        //we start with validation
        if($category->category_name != $request->input('category_name')) {
            $this->validate($request, array(
                'category_name' => 'required|unique:categories,category_name',
                'category_code' => 'required',
                'category_status' => 'required'
            ));
        }else{
            $this->validate($request, array(
                'category_name' => 'required',
                'category_code' => 'required',
                'category_status' => 'required'
            ));
        }
        //define column names and values
        $category->category_name = $request->input('category_name');
        $category->category_code = $request->input('category_code');
        $category->category_status =$request->input('category_status');
        $category->parent_category = (!empty(request('parent_category'))) ? $request->input('parent_category') : NULL;
        $category->save();

        Session::flash('success','The category has been updated');
        return redirect()->route('category.index');
    }
    public function destroyCategory($id){
        $category = Category::find($id);
        $category->delete();

        Session::flash('success','The category has been deleted');
        return redirect()->route('category.index');
    }


    public function getSubCategories(){
        $subcategories = SubCategory::all();
        $categories = Category::all();
        return view('inventory.subcategories')->with(array(
            'subcategories'=>$subcategories,
            'categories'=>$categories
        ));

    }
    public function addSubCategory(Request $request){
//        var_dump($_POST);die;
        $this->validate($request, array(
            'category_id'=>'required',
            'sub_category_name'=> 'required|unique:sub_categories,sub_category_name',
            'sub_category_code'=>'required|unique:sub_categories,sub_category_code',
            'sub_category_status'=>'required'
        ));

        $subcategory = new SubCategory();

        $subcategory->category_id = $request->category_id;
        $subcategory->sub_category_name = $request->sub_category_name;
        $subcategory->sub_category_code = $request->sub_category_code;
        $subcategory->sub_category_status =$request->sub_category_status;

        $subcategory->save();

        Session::flash('success','The sub category has been added');
        return redirect()->route('sub_category.index');

    }
    public function getSubCatAilments($id){
        $sub_cat = SubCategory::find($id);
        return json_encode($sub_cat);
    }

    public function updateSubcategory(Request $request, $id){
//        var_dump($_POST);
        $sub_cat = SubCategory::find($id);
        if($sub_cat->sub_category_name != $request->input('sub_category_name')) {
            $this->validate($request, array(
                'category_id' => 'required',
                'sub_category_name' => 'required|unique:sub_categories,sub_category_name',
                'sub_category_code' => 'required',
                'sub_category_status' => 'required'
            ));
        }else{
            $this->validate($request, array(
                'category_id' => 'required',
                'sub_category_name' => 'required',
                'sub_category_code' => 'required',
                'sub_category_status' => 'required'
            ));
        }
        $sub_cat->category_id = $request->input('category_id');
        $sub_cat->sub_category_name = $request->input('sub_category_name');
        $sub_cat->sub_category_code = $request->input('sub_category_code');
        $sub_cat->sub_category_status =$request->input('sub_category_status');

        $sub_cat->save();

        Session::flash('success','The sub category has been edited');
        return redirect()->route('sub_category.index');
    }

    public function destroySubcategory($id){
        $sub_cat = SubCategory::find($id);
        $sub_cat->delete();

        Session::flash('success','The sub category has been deleted');
        return redirect()->route('sub_category.index');
    }
    public function getWarehouses(){
        $warehouses = Warehouse::all();
        return view('inventory.warehouses')->withWarehouses($warehouses);
    }

    public function addWarehouse(Request $request){
       // var_dump($_POST);die;
        $this->validate($request, array(
            'warehouse_name'=> 'required|unique:warehouses',
            'warehouse_code'=>'required|unique:warehouses',
            'warehouse_status'=>'required'
        ));

        $warehouse = new Warehouse();
        $warehouse->warehouse_name = $request->warehouse_name;
        $warehouse->warehouse_code = $request->warehouse_code;
        $warehouse->warehouse_status = $request->warehouse_status;
        $warehouse->save();

        Session::flash('success','The warehouse has been added');
        return redirect('warehouses');

    }

    public function destroyWarehouse($id){
        if(Warehouse::destroy($id)){
            Session::flash('success','The warehouse has been deleted');
            return redirect('warehouses');
        }
    }

    public function getWarehouse(Request $request){
        $id = $request->warehouse_id;
        $warehouse = Warehouse::find($id);
        return Response::json($warehouse);
    }

    public function updateWarehouse(Request $request, $id){
        $warehouse = Warehouse::find($id);
        if($warehouse->warehouse_name != $request->input('warehouse_name')) {
            $this->validate($request, array(
                'warehouse_name'=> 'required|unique:warehouses',
                'warehouse_code'=>'required',
                'warehouse_status'=>'required'
            ));
        }else{
            $this->validate($request, array(
                'warehouse_name'=> 'required',
                'warehouse_code'=>'required',
                'warehouse_status'=>'required'
            ));
        }
        $warehouse->warehouse_name = $request->input('warehouse_name');
        $warehouse->warehouse_code = $request->input('warehouse_code');
        $warehouse->warehouse_status =$request->input('warehouse_status');

        $warehouse->save();

        Session::flash('success','The warehouse has been edited');
        return redirect('warehouses');
    }

    public function loadSubCategories($cat_id){
        $sub_cats = Category::where('parent_category', $cat_id)->get();

        return Response::json($sub_cats);
    }

    public function getCategoryName($cat_id){
        return Category::find($cat_id);
    }
}
