@extends('layouts.dt')
@section('title','User Roles')
@section('page-title','Manage User Roles')
@section('page-title-small', 'Warehouses')
@section('breadcrumbs')
    <li >
        <i class="icon-home"></i>
        <a href="{{ url('/home') }}">Home</a>
        <span class="icon-angle-right"></span>
    </li>
    <li>
        <a href="#">User Management</a>
        <span class="icon-angle-right"></span>
    </li>
    <li><a href="#">Roles</a></li>
@endsection

@section('widget-title') Manage User Roles - <span class="step-title">Step 1 of 2</span> @endsection

@section('content')
    <div class="form-wizard">
            <div class="navbar steps">
                <div class="navbar-inner">
                    <ul class="row-fluid">
                        <li class="span3">
                            <a href="#tab1" data-toggle="tab" class="step active">
                                <span class="number">1</span>
                                <span class="desc"><i class="icon-ok"></i>Manage Roles</span>
                            </a>
                        </li>
                        <li class="span3">
                            <a href="#tab2" data-toggle="tab" class="step">
                                <span class="number">2</span>
                                <span class="desc"><i class="icon-ok"></i>Allocate Views & Actions</span>
                            </a>
                        </li>
                        {{--<li class="span3">--}}
                        {{--<a href="#tab3" data-toggle="tab" class="step">--}}
                        {{--<span class="number">3</span>--}}
                        {{--<span class="desc"><i class="icon-ok"></i> Billing Setup</span>--}}
                        {{--</a>--}}
                        {{--</li>--}}
                    </ul>
                </div>
            </div>
            {{--<div id="bar" class="progress progress-success progress-striped">--}}
                {{--<div class="bar"></div>--}}
            {{--</div>--}}
            <div class="tab-content">
                @include('layouts.includes._messages')
                <div class="tab-pane active" id="tab1">
                    <h3>Add Roles</h3>
                    @include('users.manage_roles')
                </div>
                <div class="tab-pane" id="tab2">
                    <h3>Allocate Views to <span id="role_name79" style="color: green;"></span></h3>
                    @include('users.allocation')
                </div>
                {{--<div class="tab-pane" id="tab3">--}}
                {{--<h4>Provide your billing and credit card details</h4>--}}
                {{--@include('masterfile.account')--}}
                {{--</div>--}}
            </div>
        </div>
@endsection