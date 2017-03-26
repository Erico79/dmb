@extends('layouts.dt')
@section('title', 'Auction Purchases')
@section('page-title', 'Auction Purchases')
@section('widget-title', 'Auction Purchases')

@push('js')
<script src="{{ URL::asset('src_js/sales/auction-purchases.js') }}"></script>
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
    <li><a href="{{ url('routes') }}">Auction Purchases</a></li>
@endsection

@section('actions')
    {{--<button class="btn btn-primary btn-small" title="Add Route" data-toggle="modal" data-target="#add-route">--}}
    {{--<i class="icon-plus"></i> Add--}}
    {{--</button>--}}
    <button id="refresh-routes" class="btn btn-info btn-small">Refresh</button>
@endsection

@section('content')
    <table id="auction" class="table table-bordered">
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

