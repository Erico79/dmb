@extends('layouts.dt')
@section('title', 'Sys Actions')
@section('page-title', 'Manage System Actions')
@section('widget-title', 'Sys Actions')

@push('js')
<script src="{{ URL::asset('src_js/system/action.js') }}"></script>
@endpush

@section('breadcrumbs')
    <li>
        <i class="icon-home"></i>
        <a href="index.php">Home</a>
        <span class="icon-right-angle"></span>
    </li>
    <li>
        System
        <span class="icon-right-angle"></span>
    </li>
    <li><a href="{{ url('sys-actions') }}">Sys Actions</a></li>
@endsection

@section('actions')
<button class="btn btn-primary btn-small" title="Add Sys Action" data-toggle="modal" data-target="#add-sysaction">
    <i class="icon-plus"></i> Add
</button>
<button id="edit-action-btn" class="btn btn-warning btn-small" title="Edit Sys Action" data-toggle data-target="#edit-sysaction">
    <i class="icon-edit"></i> Edit
</button>
<button id="delete-action-btn" class="btn btn-danger btn-small" title="Delete Sys Action">
    <i class="icon-trash"></i> Delete
</button>
<button id="refresh-actions" class="btn btn-info btn-small">Refresh</button>
@endsection

@section('content')
    <div id="feedback"></div>
    <table id="sysaction" class="table table-bordered">
        <thead>
        <tr>
            <th>ID#</th>
            <th>Name</th>
            <th>Code</th>
            <th>Route</th>
            <th>Status</th>
            <th>Create User</th>
        </tr>
        </thead>
    </table>
@endsection

@section('modals')
    <form action="{{ url('/add-action') }}" method="post" id="add-sysaction-form">
        {{ csrf_field() }}
        <div id="add-sysaction" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel1">Add Sys Action</h3>
            </div>
            <div class="modal-body">
                <div class="row-fluid">
                    <label for="action_name">Action Name:</label>
                    <input type="text" name="action_name" class="span12" required>
                </div>

                <div class="row-fluid">
                    <label for="action_type">Action Type:</label>
                    <select name="action_type" class="span12">
                        <option value="">--Choose Action Type--</option>
                        <option value="submit">Submit</option>
                        <option value="reset">Reset</option>
                        <option value="button">Button</option>
                    </select>
                </div>

                <div class="row-fluid">
                    <label for="icon">Icon:</label>
                    <input type="text" name="icon" class="span12">
                </div>

                <div class="row-fluid">
                    <label for="action_class">Class:</label>
                    <input type="text" name="action_class" class="span12">
                </div>

                <div class="row-fluid">
                    <label for="action_category">Action Category:</label>
                    <select name="action_category" class="span12">
                        <option value="">--Choose Action Category--</option>
                        <option value="form">Form</option>
                        <option value="section">Section</option>
                    </select>
                </div>

                <label for="route_id">Route:</label>
                <div class="row-fluid" style="margin-bottom: 10px;">
                    <select name="route_id" id="sys_route" class="span12">
                        <option value=""></option>
                    </select>
                </div>

                <div class="row-fluid">
                    <label for="action_status">Action status:</label>
                    <select name="action_status" class="span12" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <div class="row-fluid">
                    <label for="action_attributes">Attributes:</label>
                    <textarea name="action_attributes" class="span12"></textarea>
                </div>

                <div class="row-fluid">
                    <label for="action_description">Action Description:</label>
                    <textarea name="action_description" class="span12"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-default" value="Close" data-dismiss="modal">
                <input type="submit" class="btn btn-primary" value="Save">
            </div>
        </div>
    </form>

    {{--edit modal--}}
    <form action="{{ url('/update-action') }}" method="post" id="edit-sysaction-form">
        {{ csrf_field() }}
        <div id="edit-sysaction" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel1">Edit Sys Action</h3>
            </div>
            <div class="modal-body">
                <div class="row-fluid">
                    <label for="action_name">Action Name:</label>
                    <input type="text" name="action_name" id="action_name" class="span12" required>
                </div>

                <div class="row-fluid">
                    <label for="action_type">Action Type:</label>
                    <select name="action_type" id="action_type" class="span12">
                        <option value="">--Choose Action Type--</option>
                        <option value="submit">Submit</option>
                        <option value="reset">Reset</option>
                        <option value="button">Button</option>
                    </select>
                </div>

                <div class="row-fluid">
                    <label for="icon">Icon:</label>
                    <input type="text" name="icon" id="icon" class="span12">
                </div>

                <div class="row-fluid">
                    <label for="action_class">Class</label>
                    <input type="text" name="action_class" id="action_class"  class="span12">
                </div>

                <div class="row-fluid">
                    <label for="action_category">Action Category:</label>
                    <select name="action_category" id="action_category" class="span12">
                        <option value="">--Choose Action Category--</option>
                        <option value="form">Form</option>
                        <option value="section">Section</option>
                    </select>
                </div>

                <label for="route_id">Route:</label>
                <div class="row-fluid" style="margin-bottom: 10px;">
                    <select name="route_id" id="ed_sys_route" class="span12">
                        <option value=""></option>
                    </select>
                </div>

                <div class="row-fluid">
                    <label for="action_status">Action status:</label>
                    <select name="action_status" id="action_status" class="span12" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <div class="row-fluid">
                    <label for="attributes">Attributes:</label>
                    <textarea name="action_attributes" id="attributes" class="span12"></textarea>
                </div>

                <div class="row-fluid">
                    <label for="action_description">Action Description:</label>
                    <textarea name="action_description" id="action_description" class="span12"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-default" value="Close" data-dismiss="modal">
                <input type="submit" class="btn btn-primary" value="Save">
            </div>
        </div>
    </form>
@endsection

