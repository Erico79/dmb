@extends('layouts.dt')
@section('title','Supplier Profile')
@section('page-title','Supplier Profile')
@section('page-title-small', 'Supplier Profile')

@section('breadcrumbs')
    <li >
        <i class="icon-home"></i>
        <a href="{{ url('/home') }}">Home</a>
        <span class="icon-angle-right"></span>
    </li>
    <li>
        <span href="#">Supplier</span>
        <span class="icon-angle-right"></span>
    </li>
    <li>
        <a href="{{ url('all-suppliers') }}">All Suppliers</a>
        <span class="icon-angle-right"></span>
    </li>
    <li><span href="#">Supplier Profile</span></li>
@endsection

@section('widget-title', '<span style="color: green;"> '.$supplier->surname.' '.$supplier->firtname.' </span>')

@section('content')
    <div class="row-fluid">
        <div class="span12">
            <!--BEGIN TABS-->
            <div class="tabbable tabbable-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab"><i class="icon-eye-open"></i> Supplier Details</a></li>
                    <li class=""><a href="#tab_2" data-toggle="tab"><i class="icon-file"></i> Documents</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane profile-classic row-fluid active"  id="tab_1">
                        @include('crm.supplier-details')
                    </div>
                    <div class="tab-pane row-fluid"  id="tab_2">
                        @include('crm.supplier-documents')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection