@extends('layouts.dt')
@section('title', 'Orders')
@section('page-title', 'Orders')
@section('widget-title', 'Orders')

@push('js')
<script src="{{ URL::asset('src_js/sales/orders.js') }}"></script>
@endpush

@section('breadcrumbs')
    <li>
        <i class="icon-home"></i>
        <a href="index.php">Home</a>
        <span class="icon-right-angle"></span>
    </li>
    <li>
        Sales
        <span class="icon-right-angle"></span>
    </li>
    <li><a href="{{ url('routes') }}">Orders</a></li>
@endsection

@section('actions')
    {{--<button class="btn btn-primary btn-small" title="Add Route" data-toggle="modal" data-target="#add-route">--}}
    {{--<i class="icon-plus"></i> Add--}}
    {{--</button>--}}
    <button id="refresh" class="btn btn-info btn-small">Refresh</button>
@endsection

@section('content')
    <table id="orders" class="table table-bordered">
        <thead>
            <tr>
                <th>Order#</th>
                <th>Order Date</th>
                <th>Created By</th>
                <th>Status</th>
                <th>View Orders</th>
            </tr>
        </thead>
    </table>
@endsection

@section('modals')
    {{--View Order Items--}}
    <div id="view-orders" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel1">Order#: <span id="order_id"></span></h3>
        </div>
        <div class="modal-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Detail#</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody id="order-details"></tbody>
            </table>
        </div>
    </div>
@endsection

