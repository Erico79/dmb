<?php

namespace App\Http\Controllers;

use App\Auction;
use App\Item;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class AuctionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('validateroutes');
    }

    public function index(){
        $auctions = Auction::all();
        $items = Item::all();
        return view('auction_manager.index', array(
            'auctions' => $auctions,
            'items' => $items
        ));
    }

    public function store(Request $request){
        // validate
        $this->validate($request, array(
            'item' => 'required',
            'auto_rollover' => 'required',
            'reserve_price' => 'required|numeric',
            'bid_cost' => 'required|numeric',
            'refresh_rate' => 'required|numeric',
            'buy_now_option' => 'required',
            'buy_now_price' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ));

        $auction = Auction::create(array(
            'item_id' => Input::get('item'),
            'auto_rollover' => Input::get('auto_rollover'),
            'reserve_price' => Input::get('reserve_price'),
            'bid_cost' => Input::get('bid_cost'),
            'refresh_rate' => Input::get('refresh_rate'),
            'buy_now_option' => Input::get('buy_now_option'),
            'buy_now_price' => Input::get('buy_now_price'),
            'start_date' => Input::get('start_date'),
            'end_date' => Input::get('end_date'),
            'status' => '1'
        ));
        $auction->save();

        $request->session()->flash('status', 'Auction Item has been added');
        return redirect('/auction-items');
    }

    public function liveAuctions(){
        $live_auctions = Auction::where('status', '1')->get();
        return view('auction_manager.live-auctions', array(
            'auctions' => $live_auctions
        ));
    }

    public function endedAuctions(){
        $live_auctions = Auction::where('status', '2')->get();
        return view('auction_manager.ended-auctions', array(
            'auctions' => $live_auctions
        ));
    }

    public function getAuctionItemData(Request $request){
        $auction = Auction::find($request->id);
        return Response::json($auction);
    }

    public function update(Request $request){
        $id = $request->edit_id;
        // validation
        $this->validate($request, array(
            'item' => 'required',
            'auto_rollover' => 'required',
            'reserve_price' => 'required|numeric',
            'bid_cost' => 'required|numeric',
            'refresh_rate' => 'required|numeric',
            'buy_now_option' => 'required',
            'buy_now_price' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ));

        Auction::where('id', $id)
            ->update(array(
                'item_id' => Input::get('item'),
                'auto_rollover' => Input::get('auto_rollover'),
                'reserve_price' => Input::get('reserve_price'),
                'bid_cost' => Input::get('bid_cost'),
                'refresh_rate' => Input::get('refresh_rate'),
                'buy_now_option' => Input::get('buy_now_option'),
                'buy_now_price' => Input::get('buy_now_price'),
                'start_date' => Input::get('start_date'),
                'end_date' => Input::get('end_date'),
//                'status' => '1'
            ));

        $request->session()->flash('status', 'Auction Item has been updated');
        return redirect('/auction-items');
    }

    public function destroy(Request $request){
        if(Auction::destroy($request->delete_id)){
            $request->session()->flash('status', 'Auction Item has been deleted');
            return redirect('/auction-items');
        }
    }
}
