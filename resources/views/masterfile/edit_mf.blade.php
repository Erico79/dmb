@extends('layouts.form-layout')
@section('title','Edit Masterfile')
@section('page-title','Edit Masterfile')
@section('page-title-small', 'Masterfile')
@section('breadcrumbs')
    <li >
        <i class="icon-home"></i>
        <a href="{{ url('/home') }}">Home</a>
        <span class="icon-angle-right"></span>
    </li>
    <li>
        <a href="{{ url('/all_mfs') }}">All Masterfile</a>
        <span class="icon-angle-right"></span>
    </li>
    <li><span>Edit Masterfile</span></li>
@endsection
@section('widget-title', 'Edit Masterfile')
@section('page-widget-title', '<span style="color:green"> '.$mf->surname.' '.$mf->firstname.' '.$mf->middlename.' </span>')

@section('content')
    <!-- BEGIN FORM -->
    <form action="{{ url('/edit_mf/'.$mf_id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
        {{ csrf_field() }}
        @include('layouts.includes._messages')
        <div class="row-fluid">
            <div class="span6">
                <div class="control-group">
                    <label for="b_role" class="control-label">Business Role<span>*</span></label>
                    <div class="controls">
                        <select name="b_role" class="span12" id="b_role">
                            <option value="Client"  {{  ($mf->b_role == 'Client') ? 'selected': '' }} >Client</option>
                            <option value="Staff" {{  ($mf->b_role == 'Staff') ? 'selected': '' }} >Staff</option>
                            <option value="Supplier" {{  ($mf->b_role == 'Supplier') ? 'selected': '' }} >Supplier</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="span6">
                <div class="control-group">
                    <label for="reg_date" class="control-label">Start Date<span>*</span></label>
                    <div class="controls">
                        <input type="text" class="date-picker span12" name="reg_date" value="{{ $mf->reg_date }}" />
                    </div>
                </div>
            </div>
        </div>

        <div class="row-fluid">
            <div class="span6">
                <div class="control-group">
                    <label for="surname" class="control-label">Surname</label>
                    <div class="controls  input-icon">
                        <input type="text" name="surname" class="span12" maxlength="20" value="{{ $mf->surname }}"/>
                    </div>
                </div>
            </div>
            <div class="span6">
                <div class="control-group">
                    <label class="control-label" for="id_passport">ID # or Passport<span>*</span></label>
                    <div class="controls">
                        <input type="text" name="id_passport" maxlength="10" value="{{ $mf->id_passport }}" class="span12" id="id_passport" placeholder="Id # or Password"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="row-fluid">
            <div class="span6">
                <div class="control-group">
                    <label for="firstname" class="control-label">First Name</label>
                    <div class="controls">
                        <input type="text" name="firstname" class="span12" id="firstname" maxlength="20" value="{{ $mf->firstname }}" placeholder="First Name"/>
                    </div>
                </div>
            </div>
            <div class="span6">
                <div class="control-group">
                    <label for="gender" class="control-label">Gender</label>
                    <div class="controls">
                        <select name="gender" class="span12" id="gender">
                            <option value="">--Choose Gender--</option>
                            <option value="1"  {{  ($mf->gender == 1) ? 'selected': '' }} >Male</option>
                            <option value="0" {{  ($mf->gender == 0) ? 'selected': '' }} >Female</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row-fluid">
            <div class="span6">
                <div class="control-group">
                    <label for="middlename" class="control-label">Middle Name</label>
                    <div class="controls">
                        <input type="text" name="middlename" class="span12" id="middlename" maxlength="20" value="{{ $mf->middlename }}" />
                    </div>
                </div>
            </div>
            <div class="span6">
                <div class="control-group">
                    <label for="email" class="control-label">Email <span>*</span></label>
                    <div class="controls">
                        <div class="input-icon left">
                            <i class="icon-envelope"></i>
                            <input type="email" name="email" class="span12" value="{{ $mf->email }}" id="email"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row-fluid">
            <div class="span6">
                <div class="control-group">
                    <label for="customer_type_name" class="control-label">Masterfile Type</label>
                    <div class="controls">
                        <select name="customer_type_name" class="span12" id="customer_type_name">
                            <option value="">--Select Masterfile Type--</option>
                            @if(count($cts))
                                @foreach($cts as $ct)
                                    <option value="{{ $mf->customer_type_name }}" {{ ($mf->customer_type_name == $mf->customer_type_name) ? 'selected': '' }}>{{ $ct->customer_type_name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            {{--<div class="span6">--}}
                {{--<div class="control-group">--}}
                    {{--<label for="user_role" class="control-label">User Roles</label>--}}
                    {{--<div class="controls">--}}
                        {{--<select name="user_role" class="span12" id="user_role">--}}
                            {{--<option value="">--Select User Role--</option>--}}
                            {{--@if(count($roles))--}}
                                {{--@foreach($roles as $role)--}}
                                    {{--<option value="{{ $mf->user_role }}" {{ ($mf->user_role == $mf->user_role) ? 'selected': '' }}>{{ $role->role_name }}</option>--}}
                                {{--@endforeach--}}
                            {{--@endif--}}
                        {{--</select>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>

        <div class="row-fluid">
            <div class="span6">
                <label class="control-label">Profile Pic</label>
                <div class="controls">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail" style="width: 120px; height: 120px;">
                            <img src="{{ URL::asset(empty($mf->image_path) ? 'assets/img/photo.jpg' : $mf->image_path) }}" alt="" />
                            {{--<img src="{{ URL::asset($mf->image_path) }}" alt="" />--}}
                        </div>
                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 120px; max-height: 120px; line-height: 20px;"></div>
                        <div>
                        <label class="btn btn-file" style="width: 103px;">
                            <span class="fileupload-new">Select image</span>
                            <span class="fileupload-exists">Change</span>
                            <input class="span12" type="file" name="image_path"/>
                        </label>
                            <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button class="btn btn-success button-submit">Save</button>
            <a href="{{ url('refresh/'.$mf->id) }}" class="btn btn-default">Reset</a>
            <a href="{{ url('soft-delete-mf/'.$mf->id) }}" class="btn btn-danger">Delete</a>
        </div>
    </form>
@endsection