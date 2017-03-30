@extends('layouts.dt')
@section('title', 'Routes')
@section('page-title', 'Manage System Routes')
@section('widget-title', 'Routes')

@push('js')
    <script src="{{ URL::asset('src_js/system/routes.js') }}"></script>
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
    <li><a href="{{ url('routes') }}">Routes</a></li>
@endsection

@section('actions')
    <button class="btn btn-primary btn-small" title="Add Route" data-toggle="modal" data-target="#add-route">
        <i class="icon-plus"></i> Add
    </button>
    <button id="edit-route-btn" class="btn btn-warning btn-small" title="Edit Route" data-toggl data-target="#edit-route">
        <i class="icon-edit"></i> Edit
    </button>
    <button id="delete-route-btn" class="btn btn-danger btn-small" title="Delete Route" data-toggle="modal" data-target="#delete-route">
        <i class="icon-trash"></i> Delete
    </button>
    <button id="refresh-routes" class="btn btn-info btn-small">Refresh</button>
@endsection

@section('content')
    <div id="feedback"></div>
    <table id="routes" class="table table-bordered">
        <thead>
            <tr>
                <th>Route#</th>
                <th>Name</th>
                <th>URL</th>
                <th>Parent</th>
                <th>Status</th>
            </tr>
        </thead>
    </table>
@endsection

@section('modals')
    <form action="{{ url('/add-route') }}" method="post" id="add-route-form">
         {{ csrf_field() }}
         <div id="add-route" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel1">Add Route</h3>
              </div>
              <div class="modal-body">
                  <div class="row-fluid">
                       <label for="route_name">Route Name:</label>
                       <input type="text" name="route_name" class="span12" required>
                  </div>

                  <div class="row-fluid">
                      <label for="url">URL:</label>
                      <input type="text" name="url" class="span12">
                  </div>

                  <label for="parent">Parent:</label>
                  <div class="row-fluid" style="margin-bottom: 10px;">
                      <select name="parent" id="parent_route" class="span12">
                          <option value=""></option>
                      </select>
                  </div>

                  <div class="row-fluid">
                      <label for="route_status">Route status:</label>
                      <select name="route_status" class="span12" required>
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                    </select>
                  </div>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-default" value="Close" data-dismiss="modal">
                <input type="submit" class="btn btn-primary" value="Save">
            </div>
         </div>
    </form>

    {{--edit modal--}}
    <form action="{{ url('/update-route') }}" method="post" id="edit-route-form">
        {{ csrf_field() }}
        <div id="edit-route" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel1">Update Route</h3>
            </div>
            <div class="modal-body">
                <div class="row-fluid">
                    <label for="route_name">Route Name:</label>
                    <input type="text" name="route_name" id="route_name" class="span12" required>
                </div>

                <div class="row-fluid">
                    <label for="url">URL:</label>
                    <input type="text" name="url" id="url" class="span12">
                </div>

                <label for="parent">Parent:</label>
                <div class="row-fluid" style="margin-bottom: 10px;">
                    <select name="parent" id="ed_parent_route" class="span12">
                        <option value=""></option>
                    </select>
                </div>

                <div class="row-fluid">
                    <label for="route_status">Route status:</label>
                    <select name="route_status" id="route_status" class="span12" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-default" value="Close" data-dismiss="modal">
                <input type="submit" class="btn btn-primary" value="Save">
            </div>
        </div>
    </form>
@endsection

