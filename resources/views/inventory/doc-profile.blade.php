@extends('layouts.dt')
@section('title','Masterfile Profile')
@section('page-title','Masterfile Profile')
@section('page-title-small', 'My Profile')

@section('breadcrumbs')
    <li >
        <i class="icon-home"></i>
        <a href="{{ url('/home') }}">Home</a>
        <span class="icon-angle-right"></span>
    </li>
    <li>
        <span href="#">Documents Manager</span>
        <span class="icon-angle-right"></span>
    </li>
    <li>
        <a href="{{ url('upload-doc-view') }}">Upload Document</a>
        <span class="icon-angle-right"></span>
    </li>
    <li><span href="#">Document Profile</span></li>
@endsection

@section('widget-title', '<span style="color: green;"> '.$doc->document_name.' </span>')

@section('actions')
    <a href="{{ URL::asset($doc->document_path) }}" target="_blank" class="btn btn-small btn-info"><i class="icon-download"></i> View/Download</a>
    <button class="btn btn-small btn-default" data-toggle="modal" data-target="#email-doc"><i class="icon-envelope"></i> Email Document</button>
    <button class="btn btn-small btn-danger" id="delete-doc"><i class="icon-trash"></i> Delete Document</button>
@endsection

@section('content')
    <form id="delete-document" action="{{ url('delete-doc') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="document_id" value="{{ $doc->id }}"/>
    </form>
    <div class="row-fluid">
        <div class="span12">
            <!--BEGIN TABS-->
            <div class="tabbable tabbable-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab"><i class="icon-eye-open"></i> Document Details</a></li>
                    <li class=""><a href="#tab_2" data-toggle="tab"><i class="icon-file"></i> Document Versions</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane profile-classic row-fluid active"  id="tab_1">
                        @include('inventory.doc-details')
                    </div>
                    <div class="tab-pane row-fluid"  id="tab_2">
                        @include('inventory.doc-versions')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="email-doc" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel1">Email Document</h3>
        </div>
        <div class="modal-body">
            <div class="row-fluid">
                <label for="group_name">Email Address:</label>
                <input type="email" name="email_address" class="span12" required>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default" value="Close" data-dismiss="modal">
            <input type="submit" class="btn btn-primary" value="Send">
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ URL::asset('src_js/documents/documents.js') }}"></script>
@endpush