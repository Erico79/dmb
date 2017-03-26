@extends('layouts.wizard-layout')
@section('title', 'Create Inventory')
@section('page-title', 'Create inventory')

@section('breadcrumb')
    <li>
        <i class="icon-home"></i>
        <a href="{{ url('/home') }}">Home</a>
        <span class="icon-angle-right"></span>
    </li>
    <li>
        <a href="#">Inventory</a>
        <span class="icon-angle-right"></span>
    </li>
    <li><a href="#">Create inventory</a></li>
@endsection

@section('wizard-id', 'form_wizard_1')

@section('wizard-title')
    <i class="icon-reorder"></i> Create a new inventory item - <span class="step-title">Step 1 of 3</span>
@endsection

@section('content')
    {{--@include('layouts.includes._messages')--}}
    <form action="{{ url('store-item') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-wizard">
            <div class="navbar steps">
                <div class="navbar-inner">
                    <ul class="row-fluid">
                        <li class="span3">
                            <a href="#tab1" data-toggle="tab" class="step active">
                                <span class="number">1</span>
                                <span class="desc"><i class="icon-ok"></i> Item details</span>
                            </a>
                        </li>
                        <li class="span3">
                            <a href="#tab2" data-toggle="tab" class="step">
                                <span class="number">2</span>
                                <span class="desc"><i class="icon-ok"></i> Inventory details</span>
                            </a>
                        </li>
                        <li class="span3">
                        <a href="#tab3" data-toggle="tab" class="step">
                        <span class="number">3</span>
                        <span class="desc"><i class="icon-ok"></i> Other Images</span>
                        </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="bar" class="progress progress-success progress-striped">
                <div class="bar"></div>
            </div>
            <div class="tab-content">
                @include('layouts.includes._messages')
                <div class="tab-pane active" id="tab1">
                    <h3>Provide inventory details</h3>
                    @include('inventory.item-details')
                </div>
                <div class="tab-pane" id="tab2">
                    <h4>Other details</h4>
                    @include('inventory.inventory-details')
                </div>
                <div class="tab-pane" id="tab3">
                <h4>Other images</h4>
                @include('inventory.more-images')
                </div>
            </div>
            <div class="form-actions clearfix">
                <a href="javascript:;" class="btn button-previous">
                    <i class="icon-angle-left"></i> Back
                </a>
                <a href="javascript:;" class="btn btn-primary blue button-next">
                    Continue <i class="icon-angle-right"></i>
                </a>

                <a href="javascript:;"  class="btn btn-success button-submit">
                    Submit <i class="icon-ok"></i>
                </a>
            </div>
        </div>

    </form>
@endsection

@push('js')
<script src="{{ URL::asset('src_js/inventory/inventory.js') }}"></script>
@endpush