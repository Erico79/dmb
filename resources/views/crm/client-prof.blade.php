@extends('layouts.dt')
@section('title','Customer Profile')
@section('page-title','Customer Profile')
@section('page-title-small', 'Customer Profile')

@section('breadcrumbs')
    <li >
        <i class="icon-home"></i>
        <a href="{{ url('/home') }}">Home</a>
        <span class="icon-angle-right"></span>
    </li>
    <li>
        <span href="#">Customer</span>
        <span class="icon-angle-right"></span>
    </li>
    <li>
        <a href="{{ url('all-customers') }}">All Customers</a>
        <span class="icon-angle-right"></span>
    </li>
    <li><span href="#">Customer Profile</span></li>
@endsection

@section('widget-title', '<span style="color: green;"> '.$customer->surname.' '.$customer->firtname.' </span>')

@section('content')
    <div class="row-fluid">
        <div class="span12">
            <!--BEGIN TABS-->
            <div class="tabbable tabbable-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab"><i class="icon-eye-open"></i> Customer Details</a></li>
                    <li class=""><a href="#tab_2" data-toggle="tab"><i class="icon-file"></i> Documents</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane profile-classic row-fluid active"  id="tab_1">
                        @include('crm.customer-details')
                    </div>
                    <div class="tab-pane row-fluid"  id="tab_2">
                        @include('crm.customer-documents')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection