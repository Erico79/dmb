<?php

namespace App\Http\Controllers;

use App\BidPackage;
use App\SalesType;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    const BuyNow = 'BUY_NOW';
    const Ordinary = 'ORDINARY_PURCHASE';
    const Auction = 'AUCTION_PURCHASE';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function buyNowPurchases(){
        return view('sales.buy-now');
    }

    public function bidSales(){
        return view('sales.bid-sales');
    }

    public function ordinaryPurchases(){
        return view('sales.ordinary-purchases');
    }

    public function auctionPurchases(){
        return view('sales.auction-purchases');
    }

    public function loadBidSales(){
        // get all item ids in bid packages
        $items = BidPackage::whereNotNull('item_id')->distinct()->get(['item_id']);
        $item_ids = [];
        if(count($items)){
            foreach ($items as $item){
                $item_ids[] = $item->item_id;
            }
        }

        $bid_sales = DB::table('sales_view')->whereIn('item_id', $item_ids);
        return Datatables::queryBuilder($bid_sales)->make(true);
    }

    public function loadBuyNowPurchases(){
        // get sale type code
        $st = SalesType::where('sale_type_code', self::BuyNow)->first();
        $buy_now_purchases = DB::table('sales_view')->where('sale_type_id', $st->id);
        return Datatables::queryBuilder($buy_now_purchases)->make(true);
    }

    public function loadOrdinaryPurchases(){
        // get sale type code
        $st = SalesType::where('sale_type_code', self::Ordinary)->first();
        $buy_now_purchases = DB::table('sales_view')->where('sale_type_id', $st->id);
        return Datatables::queryBuilder($buy_now_purchases)->make(true);
    }

    public function loadAuctionPurchases(){
        // get sale type code
        $st = SalesType::where('sale_type_code', self::Auction)->first();
        $buy_now_purchases = DB::table('sales_view')->where('sale_type_id', $st->id);
        return Datatables::queryBuilder($buy_now_purchases)->make(true);
    }
}
