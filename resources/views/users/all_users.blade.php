@extends('layouts.dt')
@section('title', 'All Users')
@section('page-title', 'All User Management')
@section('widget-title', 'All Users')

@push('js')
<script src="{{ URL::asset('src_js/users/all_users.js') }}"></script>
@endpush

@section('breadcrumbs')
    <li>
        <i class="icon-home"></i>
        <a href="index.php">Home</a>
        <span class="icon-right-angle"></span>
    </li>
    <li>
        User Management
        <span class="icon-right-angle"></span>
    </li>
    <li><a href="{{ url('all-users') }}">All Users</a></li>
@endsection

@section('actions')
    <button id="reset-pass-btn" class="btn btn-primary btn-small" title="Reset User Password">
        <i class="icon-edit"></i> Reset Password
    </button>
    <button id="delete-user-btn" class="btn btn-danger btn-small" title="Delete User Account">
        <i class="icon-trash"></i> Delete
    </button>
    <button id="refresh-actions" class="btn btn-info btn-small">Refresh</button>
@endsection


@section('content')
    <div id="feedback"></div>
    <table id="all_users" class="table table-bordered">
        <thead>
        <tr>
            <th>Id#</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Status</th>
            <th>User Role</th>
            <th>Created</th>
            <th>Manage</th>
            <th>Profile</th>
        </tr>
        </thead>
    </table>
@endsection