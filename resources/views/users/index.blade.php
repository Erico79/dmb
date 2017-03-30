@extends('layouts.dt')
@section('title', 'Manage Revenue Channel')
@section('page-title', 'Manage Revenue Channel')
@section('widget-title', 'Revenue Channels')

@push('js')
    <script src="{{ URL::asset('src_js/users/index.js') }}"></script>
@endpush

@section('breadcrumbs')
    <li>
        <i class="icon-home"></i>
        <a href="{{ url('/home') }}">Home</a>
        <span class="icon-angle-right"></span>
    </li>
    <li>
        <a href="#">User Management</a>
        <span class="icon-angle-right"></span>
    </li>
    <li><a href="#">All Users</a></li>
@endsection

@section('actions')
    <a href="#edit_user" class="btn btn-small btn-warning" title="Update User Details" id="edit-user">
        <i class="icon-edit"></i> Update</a>
    <a href="#delete_user" class="btn btn-small btn-danger" title="Delete User Account" id="delete-user">
        <i class="icon-trash"></i> Delete</a>
@endsection

@section('content')
    @include('common.success')
    @include('common.warnings')
    <table id="table1" class="table table-bordered">
        <thead>
        <tr>
            <th>User#</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
            @if(count($users))
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ($user->status) ? 'Active' : 'Blocked' }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <div class="clearfix"></div>
@endsection
@section('modals')
    {{--Add Modal--}}
    <form action="{{ url('/update-user') }}" method="post">
        {{ csrf_field() }}
        <div id="edit_user" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel1">Update User Details</h3>
            </div>
            <div class="modal-body">
                <div class="row-fluid">
                    <label for="status">Status:</label>
                    <select name="status" id="status" class="span12">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
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
    <form action="{{ url('/delete-user') }}" method="post">
        {{ csrf_field() }}
        <div id="delete_user" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel1">Delete User</h3>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the user from the system?</p>
            </div>

            {{--hidden fields--}}
            <input type="hidden" name="delete_id" id="delete_id"/>
            <input type="hidden" name="_method" value="delete"/>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> No</button>
                <button class="btn btn-danger"><i class="icon-remove"></i> Yes</button>
            </div>
        </div>
    </form>
@endsection
