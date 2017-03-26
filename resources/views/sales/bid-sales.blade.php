@extends('layouts.dt')
@section('title', 'Bid Sales')
@section('page-title', 'Bid Sales')
@section('widget-title', 'Bid Sales')

@push('js')
<script src="{{ URL::asset('src_js/sales/bid_sales.js') }}"></script>
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
    <li><a href="{{ url('routes') }}">Bid Sales</a></li>
@endsection

@section('actions')
    {{--<button class="btn btn-primary btn-small" title="Add Route" data-toggle="modal" data-target="#add-route">--}}
    {{--<i class="icon-plus"></i> Add--}}
    {{--</button>--}}
    <button id="refresh" class="btn btn-info btn-small">Refresh</button>
@endsection

@section('content')
    <table id="bid-sales" class="table table-bordered">
        <thead>
        <tr>
            <th>Sale#</th>
            <th>Sale Type</th>
            <th>Sales Date</th>
            <th>Customer</th>
            <th>Transaction#</th>
            <th>Amount</th>
            <th>Item</th>
        </tr>
        </thead>
    </table>
@endsection

