@extends('layouts.dashboard-layout')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Statistics and more')

@section('breadcrumb')
    <li>
        <i class="icon-home"></i>
        <a href="{{ url('/home') }}">Dashboard</a>
        {{--<span class="icon-angle-right"></span>--}}
    </li>
{{--    <li><a href="{{ url('/home') }}">Dashboard</a></li>--}}
@endsection

@section('content')
    <h1>Welcome</h1>
@endsection