@extends('layouts.dt')
@section('title','All Uploaded Documents')
@section('page-title','All Uploaded Documents')
@section('page-title-small', 'All Uploaded Documents')
@section('breadcrumbs')
    <li >
        <i class="icon-home"></i>
        <a href="{{ url('/home') }}">Home</a>
        <span class="icon-angle-right"></span>
    </li>
    <li>
        <a href="#">Reports</a>
        <span class="icon-angle-right"></span>
    </li>
    <li><a href="#">All Uploaded Documents</a></li>
@endsection

@section('widget-title', 'All Uploaded Documents')

@section('filter')
    <div class="widget">
        <div class="widget-title"><h4><i class="icon-search"></i> Advanced Search</h4>
            <span class="tools">
                <a href="#"><i class="icon-chevron-up"></i> </a>
            </span>
        </div>
        <div class="widget-body form" style="display: none;">
            <form action="" method="GET" class="form-horizontal">
                <div class="row-fluid">
                    <div class="span6">
                        <div class="control-group">
                            <label for="search_customer" class="control-label">Filter By:</label>
                            <div class="controls">
                                <select name="filter_by" class="span12">
                                    <option value="">--All--</option>
                                    @if(count($all))
                                        @foreach($all as $item)
                                            <option value="{{ $item->id }}">{{ $item->surname.' '.$item->firtstname.' ('.$item->b_role.')' }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="span6">
                        <div class="control-group">
                            <label for="search_customer" class="control-label">Category/SubCategory:</label>
                            <div class="controls">
                                <select name="filter_by" class="span12">
                                    <option value="">--All--</option>
                                    @if(count($cats))
                                        @foreach($cats as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span6">
                        <div class="control-group">
                            <label for="search_customer" class="control-label">Date Range:</label>
                            <div class="controls">
                                <input type="text" class="span12" name="date-range"/>
                            </div>
                        </div>
                    </div>

                    <div class="span6">
                        <div class="control-group">
                            <label for="search_customer" class="control-label">Staff:</label>
                            <div class="controls">
                                <select name="filter_by" class="span12">
                                    <option value="">--All--</option>
                                    @if(count($staff))
                                        @foreach($staff as $item)
                                            <option value="{{ $item->id }}">{{ $item->surname.' '.$item->firstname }}</option>
                                        @endforeach
                                    @endif
                                </select>
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
    <table class="table table-bordered" id="table1" >
        <thead>
        <tr>
            <th>Id</th>
            <th>Document name</th>
            <th>Created By</th>
            <th>Customer</th>
            <th>Supplier</th>
            <th>Download</th>
        </tr>
        </thead>
        <tbody>
        @if(count($documents))
            @foreach($documents as $doc)
                <tr>
                    @php
                        $mf_id = \App\User::find($doc->created_by)->masterfile_id;
                        $mf = \App\Masterfile::find($mf_id);
                        $created_by = $mf->surname.' '.$mf->firstname.' '.$mf->middlename;

                        // get customer
                        $customer = \App\Masterfile::find($doc->customer_mfid);

                        // get supplier
                        $supplier = \App\Masterfile::find($doc->supplier_mfid);
                    @endphp
                    <td>{{ $doc->id }}</td>
                    <td>{{ $doc->document_name }}</td>
                    <td>{{ $created_by  }}</td>
                    <td>{{ $customer->surname.' '.$customer->firstname }}</td>
                    <td>{{ (!empty($doc->supplier_mfid)) ? $supplier->surname.' '.$supplier->firstname : ''  }}</td>
                    <td>
                        <a href="{{ URL::asset($doc->document_path) }}" class="btn btn-mini btn-success edit_cat" data-toggle="modal">
                            <i class="icon-download"></i> View/Download</a>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>

    </table>
@endsection