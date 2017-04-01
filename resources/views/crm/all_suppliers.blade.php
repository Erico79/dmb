@extends('layouts.dt')
@section('title', 'All Suppliers')
@section('page-title', 'Suppliers')
@section('widget-title', 'All Suppliers')

@push('js')
<script src="{{ URL::asset('src_js/crm/all_suppliers.js') }}"></script>
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
    <li><span>All Suppliers</span></li>
@endsection

@section('filter')
    <div class="widget">
        <div class="widget-title"><h4><i class="icon-search"></i> Search for Supplier by Name</h4>
            <span class="tools">
                <a href="#"><i class="icon-chevron-up"></i> </a>
            </span>
        </div>
        <div class="widget-body form" style="display: none;">
            <form action="" method="GET" class="form-horizontal">
                <div class="row-fluid">
                    <div class="span6">
                        <div class="control-group">
                            <label for="search_customer" class="control-label">Supplier Name:</label>
                            <div class="controls">
                                <input type="text" id="search_supplier" class="span12" placeholder="Type Supplier's name"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('content')
    <table id="all_suppliers" class="table table-bordered">
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
    </table>
@endsection