@extends('layouts.dt')
@section('title', 'Audit Trail')
@section('page-title', 'System Audit Trail')
@section('widget-title', 'Audit Trail')

@push('js')
<script src="{{ URL::asset('src_js/users/audit_trail.js') }}"></script>
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
    <li><a href="{{ url('audit_trail') }}">Audit Trail</a></li>
@endsection

@section('actions')
    <button id="refresh-audits" class="btn btn-info btn-small">Refresh</button>
@endsection

@section('content')
    <div id="feedback"></div>
    <table id="audit_trails" class="table table-bordered">
        <thead>
        <tr>
            <th>ID#</th>
            <th>Case Name</th>
            <th>Description</th>
            <th>Create Date</th>
            <th>Create User</th>
        </tr>
        </thead>
    </table>
@endsection
