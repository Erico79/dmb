@extends('layouts.wizard-layout')
@section('title', 'Add New Masterfile')
@section('page-title', 'Add Masterfile')

@section('breadcrumb')
    <li>
        <i class="icon-home"></i>
        <a href="{{ url('/home') }}">Home</a>
        <span class="icon-angle-right"></span>
    </li>
    <li>
        <span>Masterfile</span>
        <span class="icon-angle-right"></span>
    </li>
    <li><span>Add New Masterfile</span></li>
@endsection

@section('wizard-id', 'form_wizard_2')

@section('wizard-title')
    <i class="icon-reorder"></i> Add New Masterfile - <span class="step-title">Step 1 of 2</span>
@endsection

@section('content')
    <form action="{{ url('add_mf') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
        {{--generating a token to prevent mismatch--}}
        {{ csrf_field() }}
        <div class="form-wizard">
            <div class="navbar steps">
                <div class="navbar-inner">
                    <ul class="row-fluid">
                        <li class="span3">
                            <a href="#tab1" data-toggle="tab" class="step active">
                                <span class="number">1</span>
                                <span class="desc"><i class="icon-ok"></i> Basic Details</span>
                            </a>
                        </li>
                        <li class="span3">
                            <a href="#tab2" data-toggle="tab" class="step">
                                <span class="number">2</span>
                                <span class="desc"><i class="icon-ok"></i> Address Details</span>
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
            <div id="bar" class="progress progress-primary progress-striped">
                <div class="bar"></div>
            </div>
            <div class="tab-content">
                @include('layouts.includes._messages')
                <div class="tab-pane active" id="tab1">
                    <h3>Provide your account details</h3>
                    @include('masterfile.basic_details')
                </div>
                <div class="tab-pane" id="tab2">
                    <h4>Provide your profile details</h4>
                    @include('masterfile.address_details')
                </div>
            </div>
            <div class="form-actions clearfix">
                <a href="javascript:;" class="btn button-previous">
                    <i class="icon-angle-left"></i> Back
                </a>
                <a href="javascript:;" class="btn btn-primary blue button-next">
                    Continue <i class="icon-angle-right"></i>
                </a>
                <button id="submit_wizard_contents" class="btn btn-success button-submit">
                    Submit <i class="icon-ok"></i>
                </button>
            </div>
        </div>
    </form>
@endsection

@push('js')
    <script src="{{ URL::asset('src_js/masterfile/masterfile.js') }}"></script>
@endpush