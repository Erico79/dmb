@extends('layouts.dt')
@section('title','User Profile')
@section('page-title','User Profile')
@section('page-title-small', 'My Profile')

@push('js')
<script src="{{ URL::asset('src_js/users/profile.js') }}"></script>
@endpush

@section('breadcrumbs')
    <li >
        <i class="icon-home"></i>
        <a href="{{ url('/home') }}">Home</a>
        <span class="icon-angle-right"></span>
    </li>
    <li>
        <span href="#"> User Management</span>
        <span class="icon-angle-right"></span>
    </li>
    <li>
        <a href="{{ url('all-users') }}">All Users</a>
        <span class="icon-angle-right"></span>
    </li>
    <li><span href="#">My Profile</span></li>
@endsection

@section('widget-title', '<span style="color: green;"> User Profile</span>')

@section('content')
    @include('layouts.includes._messages')
    <form enctype="multipart/form-data" class="form-horizontal" method="post" id= "" class="widget">
        <div class="row-fluid">
            <div class="span12">
                <!--BEGIN TABS-->
                <div class="tabbable tabbable-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1_1" data-toggle="tab"><i class="icon-user"></i> User Profile</a></li>
                        <li class=""><a href="#tab_1_2" data-toggle="tab"><i class="icon-book"></i> Audit Trails</a></li>
                        {{--<li class=""><a href="#tab_1_3" data-toggle="tab"><i class="icon-key"></i> Change Password</a></li>--}}
                    </ul>
                    {{-- tabs panes --}}
                    <div class="tab-content">
                        <div class="tab-pane profile-classic row-fluid active"  id="tab_1_1">
                            @include('users.my_profile_info')
                        </div>

                        <div class="tab-pane profile-classic row-fluid" id="tab_1_2">
                            @include('users.my_audit_trail')
                            <input type="hidden" id="us_id" value="{{$us->id }}">
                        </div>

                        {{--<div class="tab-pane profile-classic row-fluid" id="tab_1_3">--}}
                            {{--@include('users.change_password')--}}
                            {{--<input type="hidden" id="us_id" value="{{$us->id }}">--}}
                        {{--</div>--}}
                    </div>

                </div>
                <!--END TABS-->
            </div>
        </div>
    </form>
@endsection