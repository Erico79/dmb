@extends('layouts.dt')
@section('title', 'Manage Auctions')
@section('page-title', 'Manage Auctions')
@section('widget-title', 'Auctions')

@push('js')
<script src="{{ URL::asset('src_js/auction/bid-package.js') }}"></script>
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
    <li><a href="#">Manage Auctions</a></li>
@endsection

@section('actions')
    <a href="#add_bid_package" class="btn btn-small btn-primary" data-toggle="modal" title="Add Bid Package">
        <i class="icon-plus"></i> Add</a>
    <a href="#edit_bid_package" class="btn btn-small btn-warning" title="Update Bid Package" id="edit-bid-package">
        <i class="icon-edit"></i> Update</a>
    <a href="#delete_bid_package" class="btn btn-small btn-danger" title="Delete Bid Package" id="delete-bid-package">
        <i class="icon-trash"></i> Delete</a>
@endsection

@section('content')
    @include('common.success')
    @include('common.warnings')
    <table id="table1" class="table table-bordered">
        <thead>
        <tr>
            <th>Package#</th>
            <th>Package Name</th>
            <th>No. of Tockens</th>
            <th>Price</th>
            <th>Service</th>
            <th>Item</th>
        </tr>
        </thead>
        <tbody>
        @if(count($bid_packages))
            @foreach($bid_packages as $package)
                <?php
                    $service = \App\ServiceChannel::find($package->service_channel_id);
                    $item_name = (!empty($package->item_id)) ? \App\Item::find($package->item_id)->item_name : '';
                ?>
                <tr>
                    <td>{{ $package->id }}</td>
                    <td>{{ $package->package_name }}</td>
                    <td>{{ $package->no_of_tockens }}</td>
                    <td>{{ $package->price }}</td>
                    <td>{{ $service->service_option }}</td>
                    <td>{{ $item_name }}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
    <div class="clearfix"></div>
@endsection

@section('modals')
    {{--Add Modal--}}
    <form action="{{ url('/add-bid-package') }}" method="post">
        {{ csrf_field() }}
        <div id="add_bid_package" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel1">Add Bid Package</h3>
            </div>
            <div class="modal-body">
                <div class="row-fluid">
                    <label for="package_name">Package Name:</label>
                    <input type="text" name="package_name" class="span12"/>
                </div>

                <div class="row-fluid">
                    <label for="no_of_tockens">No of Tockens:</label>
                    <input type="number" name="no_of_tockens" class="span12"/>
                </div>

                <div class="row-fluid">
                    <label for="price">Price:</label>
                    <input type="number" step="any" min="0" name="price" class="span12"/>
                </div>

                <label for="bid_cost">Service:</label>
                <div class="row-fluid" style="margin-bottom: 10px;">
                    <select name="service" class="span12 live_search">
                        <option value="">--Choose Service--</option>
                        @if(count($services))
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->service_option }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <label for="item">Inventory Item:</label>
                <div class="row-fluid">
                    <select name="item" class="span12 live_search">
                        <option value="">--Choose Item--</option>
                        @if(count($items))
                            @foreach($items as $item)
                                <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> Close</button>
                <button class="btn btn-primary"><i class="icon-save"></i> Save</button>
            </div>
        </div>
    </form>
    {{--End Add Modal--}}

    <form action="{{ url('/update-bid-package') }}" method="post">
        {{ csrf_field() }}
        <div id="edit_bid_package" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel1">Update Bid Package</h3>
            </div>
            <div class="modal-body">
                <div class="row-fluid">
                    <label for="package_name">Package Name:</label>
                    <input type="text" name="package_name" id="package_name" class="span12"/>
                </div>

                <div class="row-fluid">
                    <label for="no_of_tockens">No of Tockens:</label>
                    <input type="number" name="no_of_tockens" id="no_of_tockens" class="span12"/>
                </div>

                <div class="row-fluid">
                    <label for="price">Price:</label>
                    <input type="number" step="any" min="0" name="price" id="price" class="span12"/>
                </div>

                <label for="bid_cost">Service:</label>
                <div class="row-fluid">
                    <select name="service" id="service" class="span12">
                        <option value="">--Choose Service--</option>
                        @if(count($services))
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->service_option }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <label for="item">Inventory Item:</label>
                <div class="row-fluid">
                    <select name="item" id="item" class="span12 live_search">
                        <option value="">--Choose Item--</option>
                        @if(count($items))
                            @foreach($items as $item)
                                <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <input type="hidden" name="edit_id" id="edit_id"/>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> Close</button>
                <button class="btn btn-primary"><i class="icon-save"></i> Save</button>
            </div>
        </div>
    </form>

    {{--Delete Modal--}}
    <form action="{{ url('/delete-bid-package') }}" method="post">
        {{ csrf_field() }}
        <div id="delete_bid_package" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel1">Delete Bid Package</h3>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the bid package?</p>
            </div>

            {{--hidden fields--}}
            <input type="hidden" name="delete_id" id="delete_id"/>
            <input type="hidden" name="_method" value="delete"/>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> No</button>
                <button class="btn btn-danger"><i class="icon-save"></i> Yes</button>
            </div>
        </div>
    </form>
@endsection