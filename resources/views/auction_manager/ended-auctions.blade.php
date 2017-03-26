@extends('layouts.dt')
@section('title', 'Ended Auctions')
@section('page-title', 'Ended Auctions')
@section('widget-title', 'Ended Auction Items')

@push('js')
{{--<script src="{{ URL::asset('src_js/users/index.js') }}"></script>--}}
@endpush

@section('breadcrumbs')
    <li>
        <i class="icon-home"></i>
        <a href="{{ url('/home') }}">Home</a>
        <span class="icon-angle-right"></span>
    </li>
    <li>
        <a href="#">Auction Manager</a>
        <span class="icon-angle-right"></span>
    </li>
    <li><a href="#">Ended Auction Items</a></li>
@endsection

@section('actions')
    {{--<a href="#add_auction_item" class="btn btn-small btn-primary" data-toggle="modal" title="Add Auction Item">--}}
    {{--<i class="icon-plus"></i> Add</a>--}}
@endsection

@section('content')
    @include('common.success')
    @include('common.warnings')

    <table id="table1" class="table table-bordered">
        <thead>
        <tr>
            <th>Auction#</th>
            <th>Item</th>
            <th>Autorollover</th>
            <th>Reserve Price</th>
            <th>Bid Cost</th>
            <th>Refresh Rate</th>
            <th>Buy Now Option</th>
            <th>Buy Now Price</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @if(count($auctions))
            @foreach($auctions as $auction)
                <?php
                $item = \App\Auction::find($auction->id)->item;
                ?>
                <tr>
                    <td>{{ $auction->id }}</td>
                    <td>{{ $item->item_name }}</td>
                    <td>{{ ($auction->auto_rollover) ? 'Yes' : 'No' }}</td>
                    <td>{{ $auction->reserve_price }}</td>
                    <td>{{ $auction->bid_cost }}</td>
                    <td>{{ $auction->refresh_rate }}</td>
                    <td>{{ ($auction->buy_now_option) ? 'Yes' : 'No' }}</td>
                    <td>{{ $auction->buy_now_price }}</td>
                    <td>{{ $auction->start_date }}</td>
                    <td>{{ $auction->end_date }}</td>
                    <td>
                        @if($auction->status == '0')
                            {{ 'Pending' }}
                        @elseif($auction->status == '1')
                            {{ 'Active' }}
                        @elseif($auction->status == '2')
                            {{ 'Ended' }}
                        @elseif($auction->status == '5')
                            {{ 'Canceled' }}
                        @endif
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
    <div class="clearfix"></div>
@endsection