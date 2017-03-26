@extends('layouts.dt')
@section('title', 'Manage Service Channel')
@section('page-title', 'Manage Service Channel')
@section('widget-title', 'Service Channels')

@push('js')
    <script src="{{ URL::asset('src_js/revenue_manager/manage_sc.js') }}"></script>
@endpush

@section('breadcrumbs')
    <li>
        <i class="icon-home"></i>
        <a href="{{ url('/home') }}">Home</a>
        <span class="icon-angle-right"></span>
    </li>
    <li>
        <a href="#">Service Channel</a>
        <span class="icon-angle-right"></span>
    </li>
    <li><a href="#">Manage Service Channels</a></li>
@endsection

@section('actions')
    <a href="#add_sc" class="btn btn-small btn-primary" title="Add Service Channel" data-toggle="modal">
        <i class="icon-plus"></i> Add
    </a>
    <a href="#edit_sc" class="btn btn-small btn-warning" title="Edit Service Channel" id="edit-sc">
        <i class="icon-edit"></i> Edit</a>
    <a href="#del_sc" class="btn btn-small btn-danger" title="Edit Service Channel"id="del-sc">
        <i class="icon-trash"></i> Delete</a>
@endsection

@section('content')
    @include('common.success')
    @include('common.warnings')
    <table id="table1" class="table table-bordered">
        <thead>
            <tr>
                <th>Service#</th>
                <th>Revenue Channel</th>
                <th>Service Option</th>
                <th>Option Code</th>
                <th>Price</th>
                <th>Parent</th>
                <th>Option Type</th>
                <th>Request Type</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @if(count($service_channels))
                @foreach($service_channels as $service_channel)
                    <?php
                        $rev = \App\ServiceChannel::find($service_channel->id)->revenueChannel;
                        $revenue_channel_name = $rev->revenue_channel_name;
                        $request_type = \App\RequestType::find($service_channel->request_type_id);
                        $request_type_name = $request_type->request_type_name;
                        $parent_sc = '';
                        if(!empty($service_channel->parent_id)){
                            $sc = \App\ServiceChannel::find($service_channel->parent_id);
                            $parent_sc = $sc->service_option;
                        }
                    ?>
                    <tr>
                        <td>{{ $service_channel->id }}</td>
                        <td>{{ $revenue_channel_name }}</td>
                        <td>{{ $service_channel->service_option }}</td>
                        <td>{{ $service_channel->option_code }}</td>
                        <td>{{ $service_channel->price }}</td>
                        <td>{{ $parent_sc }}</td>
                        <td>{{ $service_channel->service_option_type }}</td>
                        <td>{{ $request_type_name }}</td>
                        <td>{{ ($service_channel->status) ? 'Active' : 'Inactive' }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <div class="clearfix"></div>
@endsection

@section('modals')
    {{--Add Modal--}}
    <form action="{{ url('/add-sc') }}" method="post">
        {{ csrf_field() }}
        <div id="add_sc" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel1">Add Service Channel</h3>
            </div>
            <div class="modal-body">
                <label for="model_id">Revenue Channel:</label>
                <div class="row-fluid" style="margin-bottom: 10px;">
                    <select name="revenue_channel" class="span12 live_search" required>
                        <option value="">--Choose Revenue Channel--</option>
                        @if(count($revenue_channels))
                            @foreach($revenue_channels as $revenue_channel)
                                <option value="{{ $revenue_channel->id }}">{{ $revenue_channel->revenue_channel_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="row-fluid">
                    <label for="model_id">Service Option:</label>
                    <input type="text" name="service_option" class="span12" required/>
                </div>

                <div class="row-fluid">
                    <label for="imei">Option Code:</label>
                    <input type="text" name="option_code" value="" class="span12" required>
                </div>

                <div class="row-fluid">
                    <label for="imei">Service Option Type:</label>
                    <select name="option_type" class="span12" required>
                        <option value="">--Choose Option Type--</option>
                        <option value="Root">Root</option>
                        <option value="Branch">Branch</option>
                        <option value="Leaf">Leaf</option>
                    </select>
                </div>

                <div class="row-fluid">
                    <label for="imei">Parent:</label>
                    <select name="parent" class="span12">
                        <option value="">No Parent</option>
                        @if(count($service_channels))
                            @foreach($service_channels as $service_channel)
                                <option value="{{ $service_channel->id }}">{{ $service_channel->service_option }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="row-fluid">
                    <label for="imei">Request Type:</label>
                    <select name="request_type" class="span12" required>
                        <option value="">--Choose Request Type--</option>
                            @if(count($rts))
                                @foreach($rts as $rt)
                                    <option value="{{ $rt->id }}">{{ $rt->request_type_name }}</option>
                                @endforeach
                            @endif
                    </select>
                </div>

                <div class="row-fluid">
                    <label for="imei">Status:</label>
                    <select name="status" class="span12">
                        <option value="1">Active</option>
                        <option value="0" selected>Inactive</option>
                    </select>
                </div>

                <div class="row-fluid" style="margin-bottom: 10px;">
                    <label for="price">Price:</label>
                    <div class="controls">
                        <input type="number" step="any" min="0" name="price" value="0" class="span12" required>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> Close</button>
                <button class="btn btn-primary"><i class="icon-save"></i> Save</button>
            </div>
        </div>
    </form>

    {{--Edit Modal--}}
    <form action="{{ url('/update-sc') }}" method="post">
        {{ csrf_field() }}
        <div id="edit_sc" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel1">Update Service Channel</h3>
            </div>
            <div class="modal-body">
                <label for="model_id">Revenue Channel:</label>
                <div class="row-fluid" style="margin-bottom: 10px;">
                    <select name="revenue_channel" id="revenue_channel" class="span12" required>
                        <option value="">--Choose Revenue Channel--</option>
                        @if(count($revenue_channels))
                            @foreach($revenue_channels as $revenue_channel)
                                <option value="{{ $revenue_channel->id }}">{{ $revenue_channel->revenue_channel_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="row-fluid">
                    <label for="model_id">Service Option:</label>
                    <input type="text" name="service_option" id="service_option" class="span12" required/>
                </div>

                <div class="row-fluid">
                    <label for="imei">Option Code:</label>
                    <input type="text" name="option_code" id="option_code" value="" class="span12" required>
                </div>

                <div class="row-fluid">
                    <label for="imei">Service Option Type:</label>
                    <select name="option_type" id="option_type" class="span12" required>
                        <option value="">--Choose Option Type--</option>
                        <option value="Root">Root</option>
                        <option value="Branch">Branch</option>
                        <option value="Leaf">Leaf</option>
                    </select>
                </div>

                <div class="row-fluid">
                    <label for="imei">Parent:</label>
                    <select name="parent" id="parent" class="span12">
                        <option value="">No Parent</option>
                        @if(count($service_channels))
                            @foreach($service_channels as $service_channel)
                                <option value="{{ $service_channel->id }}">{{ $service_channel->service_option }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="row-fluid">
                    <label for="imei">Request Type:</label>
                    <select name="request_type" id="request_type" class="span12" required>
                        <option value="">--Choose Request Type--</option>
                        @if(count($rts))
                            @foreach($rts as $rt)
                                <option value="{{ $rt->id }}">{{ $rt->request_type_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="row-fluid">
                    <label for="imei">Status:</label>
                    <select name="status" id="status" class="span12">
                        <option value="1">Active</option>
                        <option value="0" selected>Inactive</option>
                    </select>
                </div>

                <div class="row-fluid" style="margin-bottom: 10px;">
                    <label for="price">Price:</label>
                    <div class="controls">
                        <input type="number" step="any" min="0" name="price" value="0" class="span12" required>
                    </div>
                </div>
            </div>

            {{--hidden fields--}}
            <input type="hidden" name="edit_id" id="edit_id"/>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> Close</button>
                <button class="btn btn-primary"><i class="icon-save"></i> Save</button>
            </div>
        </div>
    </form>

    {{--Delete Modal--}}
    <form action="{{ url('/delete-sc') }}" method="post">
        {{ csrf_field() }}
        <div id="del_sc" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel1">Delete Revenue Channel</h3>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete revenue channel?</p>

                {{--hidden fields--}}
                <input type="hidden" name="delete_id" id="delete_id" required/>
                <input type="hidden" name="_method" value="delete"/>
            </div>

            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> No</button>
                <button class="btn btn-danger"><i class="icon-remove"></i> Yes</button>
            </div>
        </div>
    </form>
@endsection