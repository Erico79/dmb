@extends('layouts.pages_layout')
@section('title', 'Access Denied')
@section('page-title', 'Access Denied')

@section('breadcrumb')
    <li>
        <i class="icon-home"></i>
        <a href="{{ url('/home') }}">Home</a>
        <span class="icon-angle-right"></span>
    </li>
    <li>Access Denied</li>
@endsection

@section('content')
    <div class="span12">
        <div class="row-fluid page-500">
            <div class="span5 number">
                403
            </div>
            <div class="span7 details">
                <h3>Access Denied.</h3>
                <p>
                    Please contact the Administrator!<br />
                    Click <a href="{{ url('/home') }}">Home</a><br />
                </p>
            </div>
        </div>
    </div>
@endsection