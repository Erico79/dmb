@extends('layouts.dt')
@section('title', 'Manage Revenue Channel')
@section('page-title', 'Manage Revenue Channel')
@section('widget-title', 'Revenue Channels')

@push('js')
    <script src="{{ URL::asset('src_js/revenue_manager/manage_rc.js') }}"></script>
@endpush

@section('breadcrumbs')
    <li>
        <i class="icon-home"></i>
        <a href="{{ url('/home') }}">Home</a>
        <span class="icon-angle-right"></span>
    </li>
    <li>
        <a href="#">Revenue Channel</a>
        <span class="icon-angle-right"></span>
    </li>
    <li><a href="#">Manage Revenue Channels</a></li>
@endsection

@section('actions')
    <a href="#add_rc" class="btn btn-small btn-primary" title="Add Revenue Channel" data-toggle="modal">
        <i class="icon-plus"></i> Add
    </a>
    <a href="#edit_rc" class="btn btn-small btn-warning" title="Edit Revenue Channel" id="edit-rc">
        <i class="icon-edit"></i> Edit</a>
    <a href="#del_rc" class="btn btn-small btn-danger" title="Edit Revenue Channel" id="del-rc">
        <i class="icon-trash"></i> Delete</a>
@endsection

@section('content')
    @include('common.success')
    @include('common.warnings')
    <table id="table1" class="table table-bordered">
        <thead>
            <tr>
                <th>Channel#</th>
                <th>Name</th>
                <th>Channel Code</th>
                <th>Head Code</th>
                <th>Sub Code</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @if(count($rcs))
                @foreach($rcs as $rc)
                    <?php
                        $ifmis_hc = \App\RevenueChannel::find($rc->id)->ifmisHeadcode;
                        $ifmis_sc = \App\RevenueChannel::find($rc->id)->ifmisSubcode;
                    ?>
                    <tr>
                        <td>{{ $rc->id }}</td>
                        <td>{{ $rc->revenue_channel_name }}</td>
                        <td>{{ $rc->revenue_channel_code }}</td>
                        <td>{{ (!empty($rc->ifmis_headcode_id)) ? $ifmis_hc->head_code_name : '' }}</td>
                        <td>{{ (!empty($rc->ifmis_subcode_id)) ? $ifmis_sc->subcode_name : '' }}</td>
                        <td>{{ ($rc->revenue_channel_status == 't') ? 'Active': 'Inactive' }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <div class="clearfix"></div>
@endsection

@section('modals')
    {{--Add Modal--}}
    <form action="{{ url('/add-rev') }}" method="post">
        {{ csrf_field() }}
        <div id="add_rc" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel1">Add Revenue Channel</h3>
            </div>
            <div class="modal-body">
                <div class="row-fluid">
                    <label for="model_id">Revenue Channel Name:</label>
                    <input type="text" name="revenue_channel_name" class="span12" required/>
                </div>

                <div class="row-fluid">
                    <label for="imei">Revenue Channel Code:</label>
                    <input type="text" name="revenue_channel_code" value="" class="span12" required>
                </div>

                <div class="row-fluid" style="margin-bottom: 10px;">
                    <label for="imei">Ifmis Subcode</label>
                    <div class="controls">
                        <select data-placeholder="Ifmis Subcodes" class="live_search span12" name="ifmis_subcode">
                            <option value=""></option>
                            @if(count($ifmis_headcodes))
                                @foreach($ifmis_headcodes as $ifmis_headcode)
                                    <optgroup label="{{ $ifmis_headcode->head_code_name }}">
                                        <?php
                                            $scs = \App\IfmisSubcode::where('ifmis_headcode_id', $ifmis_headcode->id)->get();
                                        ?>
                                            @if(count($scs))
                                                @foreach($scs as $sc)
                                        <option value="{{ $sc->id }}">{{ $sc->subcode_name }}</option>
                                        @endforeach
                                    @endif
                                    </optgroup>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="row-fluid">
                    <label for="imei">Status:</label>
                    <select name="status" class="span12">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> Close</button>
                <button class="btn btn-primary"><i class="icon-save"></i> Save</button>
            </div>
        </div>
    </form>

    {{--Edit Modal--}}
    <form action="{{ url('/update-rev') }}" method="post">
        {{ csrf_field() }}
        <div id="edit_rc" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel1">Update Revenue Channel</h3>
            </div>
            <div class="modal-body">
                <div class="row-fluid">
                    <label for="model_id">Revenue Channel Name:</label>
                    <input type="text" name="revenue_channel_name" id="revenue_channel_name" class="span12" required/>
                </div>

                <div class="row-fluid">
                    <label for="imei">Revenue Channel Code:</label>
                    <input type="text" name="revenue_channel_code" id="revenue_channel_code" class="span12" required>
                </div>

                <div class="row-fluid">
                    <label for="imei">Ifmis Subcode</label>
                    <div class="controls">
                        <select data-placeholder="Ifmis Subcodes" class="span12" name="ifmis_subcode" id="ifmis_subcode">
                            <option value=""></option>
                            @if(count($ifmis_headcodes))
                                @foreach($ifmis_headcodes as $ifmis_headcode)
                                    <optgroup label="{{ $ifmis_headcode->head_code_name }}">
                                        <?php
                                        $scs = \App\IfmisSubcode::where('ifmis_headcode_id', $ifmis_headcode->id)->get();
                                        ?>
                                        @if(count($scs))
                                            @foreach($scs as $sc)
                                                <option value="{{ $sc->id }}">{{ $sc->subcode_name }}</option>
                                            @endforeach
                                        @endif
                                    </optgroup>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                {{--hidden fields--}}
                <input type="hidden" name="edit_id" id="edit_id" required/>
                <div class="row-fluid">
                    <label for="imei">Status:</label>
                    <select name="status" class="span12" id="status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> Close</button>
                <button class="btn btn-primary"><i class="icon-save"></i> Save</button>
            </div>
        </div>
    </form>

    {{--Delete Modal--}}
    <form action="{{ url('/delete-rev') }}" method="post">
        {{ csrf_field() }}
        <div id="del_rc" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
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