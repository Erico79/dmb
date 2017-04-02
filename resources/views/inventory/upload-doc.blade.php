@extends('layouts.dt')
@section('title','Upload Documents')
@section('page-title','Upload Documents')
@section('page-title-small', 'Upload Documents')
@section('breadcrumbs')
    <li >
        <i class="icon-home"></i>
        <a href="{{ url('/home') }}">Home</a>
        <span class="icon-angle-right"></span>
    </li>
    <li>
        <a href="#">Documents Manager</a>
        <span class="icon-angle-right"></span>
    </li>
    <li><a href="#">Upload Documents</a></li>
@endsection

@section('widget-title', 'Upload Documents')

@section('actions')
    <a href="#upload-doc" class="btn btn-primary btn-small" data-toggle="modal"><i class="icon-upload"></i> Upload a Document</a>
    <a href="#users-access" class="btn btn-warning btn-small" data-toggle="modal"><i class="icon-eye-open"></i> Who can See?</a>
@endsection

@section('content')
    @include('common.success')
    @include('common.warnings')
    @include('common.warning')
    <table class="table table-bordered" id="table1" >
        <thead>
        <tr>
            <th>Id</th>
            <th>Document name</th>
            <th>Created By</th>
            <th>Customer</th>
            <th>Supplier</th>
            <th>Category</th>
            <th>Sub Category</th>
            <th>Icon</th>
            <th>Visibility</th>
            <th></th>
            <th></th>
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

                        // get category
                        $category = \App\Category::find($doc->category_id);

                        $subcat_name = '';
                        if(!empty($doc->subcat_id))
                            $subcat_name = \App\Category::find($doc->subcat_id)->category_name;

                        $doc_obj = new \App\Http\Controllers\DocumentController();
                        $icon = $doc_obj->getDocIcon($doc->document_path);
                    @endphp
                    <td>{{ $doc->id }}</td>
                    <td>{{ $doc->document_name }}</td>
                    <td>{{ $created_by  }}</td>
                    <td>{{ (!empty($doc->customer_mfid)) ? $customer->surname.' '.$customer->firstname : ''  }}</td>
                    <td>{{ (!empty($doc->supplier_mfid)) ? $supplier->surname.' '.$supplier->firstname : ''  }}</td>
                    <td>{{ $category->category_name }}</td>
                    <td>{{ $subcat_name }}</td>
                    <td>{!! $icon !!}</td>
                    <td>{!! ($doc->public) ? '<span class="label label-success">Public</span>' : '<span class="label label-default">Private</span>' !!}</td>
                    <td>
                        <a href="{{ URL::asset($doc->document_path) }}" class="btn btn-mini btn-success edit_cat"
                           data-toggle="modal" title="Download/View Document">
                            <i class="icon-download"></i> </a>
                    </td>
                    <td>
                        <a href="{{ url('/document/show/'.$doc->id) }}" class="btn btn-mini btn-info"> <i class="icon-eye-open"></i> Profile</a>
                    </td>
                </tr>
            @endforeach
            @endif
        </tbody>

    </table>

@endsection
@section('modals')
    {{--modal for uploading docs--}}
    <form action="{{ url('/process-upload') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div id="upload-doc" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel1"><i class="icon-upload"></i> Upload a Document</h3>
            </div>
            <div class="modal-body">
                <div class="row-fluid">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="span12" required>
                        <option value="">--Choose Category--</option>
                        @if(count($categories))
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="row-fluid" id="sub_category" style="display: none;">
                    <label for="sub_category">Sub Category</label>
                    <select name="sub_category" class="span12"></select>
                </div>
                <div class="row-fluid">
                    <label for="doc_name">Document Name</label>
                    <input type="text" name="document_name" id="doc_name" class="span12" required>
                </div>
                <div class="row-fluid">
                    <label for="uploaded_doc">Upload Document</label>
                    {{--<input type="file" name="uploaded_doc" id="uploaded_doc" class="span12" required>--}}
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="input-append">
                            <div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div><span class="btn btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span>
                                        <input type="file" name="uploaded_doc" class="default" />
                                          </span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                        </div>
                    </div>
                </div>
                <label for="customer">Attach Document to:</label>
                <div class="row-fluid">
                    <select name="attach_to" id="attach_to" class="span12" required>
                        <option value="">--Attach To--</option>
                        <option value="customer">Customer</option>
                        <option value="supplier">Supplier</option>
                    </select>
                </div>
                <div id="select_customer" style="display: none; margin-bottom: 10px;">
                    <label for="customer">Customer</label>
                    <div class="row-fluid">
                        <select name="customer" class="span12">
                            <option value="">--Choose Customer--</option>
                            @if(count($customers))
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->surname.' '.$customer->firstname.' '.$customer->middlename }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div id="select_supplier" style="display: none; margin-bottom: 10px;">
                    <label for="supplier">Supplier</label>
                    <div class="row-fluid">
                    <select name="supplier" id="select_supplier" class="span12">
                        <option value="">--Choose Supplier--</option>
                        @if(count($suppliers))
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                </div>
                <label for="attach_to_doc">Attach to Document</label>
                <div class="row-fluid">
                    <select name="attach_to_doc" id="attach_to_doc" class="span12">
                        <option value="">--Parent Doc--</option>
                        @if(count($documents))
                            @foreach($documents as $doc)
                                <option value="{{$doc->id}}">{{$doc->document_name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <label for="public">Visibility</label>
                <div class="row-fluid">
                    <div class="text-toggle-button">
                        <input type="checkbox" name="visibility" class="toggle" value="1" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-default" value="Close" data-dismiss="modal">
                <input type="submit" class="btn btn-primary" value="Save">
            </div>
        </div>
    </form>

    {{--modal for setting users that can view the doc--}}
    <form action="{{ url('/who-can-see') }}" method="post">
        {{ csrf_field() }}
        <div id="users-access" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel1"><i class="icon-eye-open"></i> Accessibility</h3>
            </div>
            <div class="modal-body">
                <select data-placeholder="Your Favorite Football Teams" class="chosen span12"style="width: 100%;" multiple tabindex="6">
                    <option value=""></option>
                    <optgroup label="NFC EAST">
                        <option>Dallas Cowboys</option>
                        <option>New York Giants</option>
                        <option>Philadelphia Eagles</option>
                        <option>Washington Redskins</option>
                    </optgroup>
                    <optgroup label="NFC NORTH">
                        <option selected>Chicago Bears</option>
                        <option>Detroit Lions</option>
                        <option>Green Bay Packers</option>
                        <option>Minnesota Vikings</option>
                    </optgroup>
                    <optgroup label="NFC SOUTH">
                        <option>Atlanta Falcons</option>
                        <option selected>Carolina Panthers</option>
                        <option>New Orleans Saints</option>
                        <option>Tampa Bay Buccaneers</option>
                    </optgroup>
                    <optgroup label="NFC WEST">
                        <option>Arizona Cardinals</option>
                        <option>St. Louis Rams</option>
                        <option>San Francisco 49ers</option>
                        <option>Seattle Seahawks</option>
                    </optgroup>
                    <optgroup label="AFC EAST">
                        <option>Buffalo Bills</option>
                        <option>Miami Dolphins</option>
                        <option>New England Patriots</option>
                        <option>New York Jets</option>
                    </optgroup>
                    <optgroup label="AFC NORTH">
                        <option>Baltimore Ravens</option>
                        <option>Cincinnati Bengals</option>
                        <option>Cleveland Browns</option>
                        <option>Pittsburgh Steelers</option>
                    </optgroup>
                    <optgroup label="AFC SOUTH">
                        <option>Houston Texans</option>
                        <option>Indianapolis Colts</option>
                        <option>Jacksonville Jaguars</option>
                        <option>Tennessee Titans</option>
                    </optgroup>
                    <optgroup label="AFC WEST">
                        <option>Denver Broncos</option>
                        <option>Kansas City Chiefs</option>
                        <option>Oakland Raiders</option>
                        <option>San Diego Chargers</option>
                    </optgroup>
                </select>
            </div>
        </div>
    </form>
@endsection

@push('js')
    <script src="{{ URL::asset('src_js/documents/documents.js') }}"></script>
@endpush
