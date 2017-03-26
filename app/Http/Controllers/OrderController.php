<?php

namespace App\Http\Controllers;

use App\Item;
use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Yajra\Datatables\Facades\Datatables;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('validateroutes');
    }

    public function index(){
        $orders = Order::all();
        return view('sales.orders', [
            'orders' => $orders
        ]);
    }

    public function loadOrders(){
        $orders = Order::query();
        return Datatables::of($orders)
            ->editColumn('status', function ($order){
                return ($order->status) ? 'Active' : 'Pending';
            })
            ->addColumn('view_orders', function($order){
                return '<button class="btn btn-mini view-orders" data-target="#view-orders" data-toggle="modal" order-id="'.$order->order_id.'"><i class="icon-eye-open"></i> View Orders</button>';
            })
            ->make(true);
    }

    public function loadOrderItems(Request $request){
        $order_id = $request->id;

        $return = [];
        $order_items = OrderDetail::where('order_id', $order_id)->get();
        if (count($order_items)){
            foreach ($order_items as $item){
                $item_name = Item::find($item->id)->item_name;
                $return[] = [
                    'id' => $item->id,
                    'item_name' => $item_name,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'subtotal' => $item->item_subtotal
                ];
            }
        }
        return Response::json($return);
    }
}
