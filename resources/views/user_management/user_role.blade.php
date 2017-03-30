@extends('layouts.dt')
@section('title', 'Manage User Roles')
@section('page-title', 'Manage User Roles')
@section('page-title-small', 'User Roles')
@section('breadcrumbs')
    <li >
        <i class="icon-home"></i>
        <a href="{{ url('/home') }}">Home</a>
        <span class="icon-angle-right"></span>
    </li>
    <li>
        <a href="#">User Management</a>
        <span class="icon-angle-right"></span>
    </li>
    <li><a href="#">Manage User Role</a></li>
@endsection
@section('widget-title', 'User Management')
@section('actions')
    <a href="#add_userole" class="btn btn-primary" data-toggle="modal">Add User Role</a>
@endsection


@section('content')
    @include('layouts.includes._messages')
    <table class="table table-bordered" id="table1" >
        <thead>
            <tr>
                <th>Id</th>
                <th>Role Name</th>
                <th>Role code</th>
                <th>Role status</th>
            </tr>
        </thead>
        <tbody>
        @if(count($roles))
            @foreach($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->role_name }}</td>
                    <td>{{ $role->role_code }}</td>
                    <td>{{ $role->$role_status }}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

@endsection
@section('modals')
    {{--modal for add--}}
    <form action="{{ url('/add_user_role') }}" method="post">
        {{ csrf_field() }}
        <div id="add_user_role" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel1">Add A Role Name</h3>
            </div>
            <div class="modal-body">

                <div class="row-fluid">
                    <label for="role_name">Role name:</label>
                    <input type="text" name="role_name" value="" class="span12" required>
                </div>
                <div class="row-fluid">
                    <label for="role_code">Role code:</label>
                    <input type="text" name="role_code" class="span12" required>
                </div>
                <label for="role_status">Role status:</label>
                <div class="row-fluid">
                    <select name="role_status" class="span12" required>
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