@extends('layouts.dt')
@section('title', 'All Customers')
@section('page-title', 'CRM')
@section('widget-title', 'All Customers')

@push('js')
    <script src="{{ URL::asset('src_js/crm/all_customers.js') }}"></script>
@endpush

@section('breadcrumbs')
    <li>
        <i class="icon-home"></i>
        <a href="index.php">Home</a>
        <span class="icon-right-angle"></span>
    </li>
    <li>
        <span href="#">CRM</span>
        <span class="icon-right-angle"></span>
    </li>
    <li><span>All Customers</span></li>
@endsection

@section('filter')
    <div class="widget">
        <div class="widget-title"><h4><i class="icon-search"></i> Search for Customer by Surname/First Name/Middle Name</h4>
            <span class="tools">
                <a href="#"><i class="icon-chevron-up"></i> </a>
            </span>
        </div>
        <div class="widget-body form" style="display: none;">
            <form action="" method="GET" class="form-horizontal">
                <div class="row-fluid">
                    <div class="span6">
                        <div class="control-group">
                            <label for="search_customer" class="control-label">Customer Name:</label>
                            <div class="controls">
                                <input type="text" id="search_customer" placeholder="Type customer's name" class="span12"/>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('content')
    <table id="all_customers" class="table table-bordered">
        <thead>
            <tr>
                <th>Id#</th>
                <th>Full Name</th>
                <th>E-mail</th>
                <th>Buss Role</th>
                <th>Masterfile Type</th>
                <th>Reg Date</th>
                <th>Profile</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
@endsection