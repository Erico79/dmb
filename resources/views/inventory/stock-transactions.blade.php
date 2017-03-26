@extends('layouts.dt')
@section('title','Stock transactions')
@section('page-title','Stock transactions')
@section('page-title-small', 'All stock transactions')
@section('breadcrumbs')
        <li >
            <i class="icon-home"></i>
            <a href="{{ url('/home') }}">Home</a>
            <span class="icon-angle-right"></span>
        </li>
        <li>
            Inventory <span class="icon-angle-right"></span>
        </li>
        <li>Stock transactions</li>
@endsection
@section('widget-title', 'All stock transactions')
@section('actions')
<a href="#add_transaction" class="btn btn-primary btn-small" data-toggle="modal">Create a transaction</a>
    @endsection
@section('content')
    @include('layouts.includes._messages')
    <table class="table table-bordered" id="table1" >
        <thead>
        <tr>
            <th>Id</th>
            <th>Item</th>
            <th>Transaction type</th>
            <th>transaction category</th>
            <th>Warehouse</th>
            <th>Quantity</th>
            <th>Warehouse stock</th>
            <th>Global stock available</th>
            <th>Transaction date</th>
            <th>Transacted by</th>
        </tr>
        </thead>
        <tbody>
        @if(count($transactions))
            @foreach($transactions as $transaction)
                <?php
                $item = \App\Item::find($transaction->item_id);
                $transaction_type = \App\TransactionType::find($transaction->transaction_type_id);
                $transaction_category = \App\TransactionCategory::find($transaction->transaction_category_id);
                $warehouse = \App\Warehouse::find($transaction->warehouse_id);
                $user = App\User::find($transaction->transacted_by);

                 ?>
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $item['item_name'] }}</td>
                    <td>{{ $transaction_type['transaction_type_name'] }}</td>
                    <td>{{ $transaction_category['transaction_category_name'] }}</td>
                    <td>{{ ($warehouse['warehouse_name'] == '')? 'Multiple warehouses':$warehouse['warehouse_name']}}</td>
                    <td>{{ $transaction->quantity }}</td>
                    <td>{{ $transaction->warehouse_stock_level }}</td>
                    <td>{{ $transaction->new_stock_level }}</td>
                    <td>{{ date('jS M Y h:i a',strtotime($transaction->created_at)) }}</td>
                    <td>{{ ($transaction->transacted_by != '')? $user['name'] : '' }}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

    @endsection
@section('modals')
    {{--add modal--}}

    <form action="{{ url('/create-transaction') }}" method="post">
        {{ csrf_field() }}
        <div id="add_transaction" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel1">Create a Transaction</h3>
            </div>
            <div class="modal-body">

                <label for="group_name">Inventory Item:</label>
                <div class="row-fluid">
                    <select name="item_id" class="span12 live_search" required>
                        <option value="">--Select inventory item--</option>
                        @if(count($items))
                            @foreach($items as $item)
                                <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <label for="group_name">Transaction type:</label>
                <div class="row-fluid">
                    <select name="transaction_type_id" class="span12 live_search" required>
                        <option value="">--Select transaction type--</option>
                    @if(count($transaction_types))
                        @foreach($transaction_types as $transaction_type)
                            <option value="{{ $transaction_type->id }}">{{ $transaction_type->transaction_type_name }}</option>
                            @endforeach
                        @endif

                    </select>
                </div>
                <label for="group_name">Transaction Categoty:</label>
                <div class="row-fluid">
                    <select name="transaction_category_id" class="span12 live_search" required>
                        <option value="">--Select transaction category--</option>
                        @if(count($transaction_categories))
                            @foreach($transaction_categories as $transaction_category)
                                <option value="{{ $transaction_category->id }}">{{ $transaction_category->transaction_category_name }}</option>
                            @endforeach
                        @endif

                    </select>
                </div>
                <label for="group_name">Warehouse:</label>
                <div class="row-fluid">
                    <select name="warehouse_id" class="span12 live_search" required>
                        <option value="">--Select warehouse--</option>
                        @if(count($warehouses))
                            @foreach($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="row-fluid">
                    <label for="group_name">Quantity:</label>
                    <input type="number" name="quantity" class="span12" required>
                </div>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-default" value="Close" data-dismiss="modal">
                <input type="submit" class="btn btn-primary" value="Save">
            </div>
        </div>
    </form>
    @endsection
