<?php

namespace App\Http\Controllers;

use App\BidPackage;
use App\Item;
use App\ServiceChannel;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Response;

class BidPackageController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index(){
        $services = ServiceChannel::where('service_option_type', 'Leaf')->get();
        $bid_packages = BidPackage::all();
        $items = Item::all();

        return view('auction_manager.bid_packages', array(
            'services' => $services,
            'bid_packages' => $bid_packages,
            'items' => $items
        ));
    }

    public function store(Request $request){
        // validation
        $this->validate($request, array(
            'package_name' => 'required:unique:bid_packages',
            'no_of_tockens' => 'required|min:0',
            'price' => 'required|numeric',
            'service' => 'required'
        ));

        $package = BidPackage::create(array(
            'package_name' => $request->package_name,
            'no_of_tockens' => $request->no_of_tockens,
            'price' => $request->price,
            'service_channel_id' => $request->service,
            'item_id' => $request->item
        ));
        $package->save();

        $request->session()->flash('status', 'Bid Package has been created');
        return redirect('/bid-packages');
    }

    public function update(Request $request){
        $id = $request->edit_id;
        $this->validate($request, array(
            'package_name' => 'required:unique:bid_packages,package_name,'.$id,
            'no_of_tockens' => 'required|min:0',
            'price' => 'required|numeric',
            'service' => 'required'
        ));

        BidPackage::where('id', $id)
            ->update(array(
                'package_name' => $request->package_name,
                'no_of_tockens' => $request->no_of_tockens,
                'price' => $request->price,
                'service_channel_id' => $request->service,
                'item_id' => $request->item
            ));

        $request->session()->flash('status', 'Bid Package has been updated');
        return redirect('/bid-packages');
    }

    public function destroy(Request $request){
        if(BidPackage::destroy($request->delete_id)){
            $request->session()->flash('status', 'Bid Package has been deleted');
            return redirect('/bid-packages');
        }
    }

    public function getBidPackage(Request $request){
        $bid_package = BidPackage::find($request->id);
        return Response::json($bid_package);
    }
}
