
    <div class="row-fluid">
        <div class="span6">
            <div class="control-group">
                <label for="b_role" class="control-label">Business Role<span>*</span></label>
                <div class="controls">
                    <select name="b_role" class="span12" id="b_role">
                        <option value="">--Choose Business Role--</option>
                        <option value="Customer" {{ (old('b_role') == 'Customer') ? 'selected' : '' }}>Customer</option>
                        <option value="Supplier" {{ (old('b_role') == 'Supplier' ? 'selected' : '') }}>Supplier</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="span6">
            <div class="control-group">
                <label for="reg_date" class="control-label">Start Date<span>*</span></label>
                <div class="controls">
                    <input type="text" class="date-picker span12" name="reg_date" readonly value="<?php
                    if(isset($_POST['reg_date'])){
                        echo $_POST['reg_date'];
                    }else{
                        echo date('Y-m-d');
                    }
                    ?>" />
                </div>
            </div>
        </div>
    </div>

    <div class="row-fluid">
        <div class="span6">
            <div class="control-group">
                <label for="surname" class="control-label">Surname</label>
                <div class="controls">
                    <input type="text" name="surname" class="span12" maxlength="20" value="{{ (old('surname')) }}" id="surname" placeholder="Surname"/>
                </div>
            </div>
        </div>
        <div class="span6">
            <div class="control-group">
                <label class="control-label" for="id_passport">ID # or Passport<span>*</span></label>
                <div class="controls">
                    <input type="text" name="id_passport" maxlength="10" value="{{ (old('id_passport')) }}" class="span12" id="id_passport" placeholder="Id # or Password"/>
                </div>
            </div>
        </div>
    </div>

    <div class="row-fluid">
        <div class="span6">
            <div class="control-group">
                <label for="firstname" class="control-label">First Name</label>
                <div class="controls">
                    <input type="text" name="firstname" class="span12" id="firstname" maxlength="20" value="{{ old('firstname') }}" placeholder="First Name"/>
                </div>
            </div>
        </div>
        <div class="span6">
            <div class="control-group">
                <label for="gender" class="control-label">Gender</label>
                <div class="controls">
                    <select name="gender" class="span12" id="gender">
                        <option value="">--Choose Gender--</option>
                        <option value="0" {{ (old('0') == 'Male') ? 'selected' : '' }}>Male</option>
                        <option value="1" {{ (old('1') == 'Female') ? 'selected' : '' }}>Female</option>
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
                    <input type="text" name="middlename" class="span12" id="middlename" maxlength="20" value="{{ old('middlename') }}" placeholder="Middle Name" />
                </div>
            </div>
        </div>
        <div class="span6">
            <div class="control-group">
                <label for="email" class="control-label">Email <span>*</span></label>
                <div class="controls">
                    <div class="input-icon left">
                        <i class="icon-envelope"></i>
                        <input type="email" name="email" class="span12" value="{{ old('email') }}" placeholder="email" id="email"/>
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
                    <select name="customer_type_name" class="span12 live_search" id="customer_type_name">
                        <option value="">--Select Masterfile Type--</option>
                        @if(count($customers))
                            @foreach($customers as $customer)
                                <option value="{{ $customer->customer_type_code }}"
                                    {{ (old('customer_type') == $customer->customer_type_code) ? 'selected': '' }}>
                                    {{ $customer->customer_type_name }}
                                </option>
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
                                {{--<option value="{{ $role->role_code }}" {{ (old('role') == $role->role_code) ? 'selected': '' }}>{{ $role->role_name }}</option>--}}
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
                    <div class="fileupload-new thumbnail" style="width: 100px; height: 100px;">
                        <img src="assets/img/photo.jpg" alt="" />
                    </div>
                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 100px; max-height: 100px; line-height: 20px;"></div>
                    <div>
                        <label class="btn btn-file"><span class="fileupload-new">Select image</span>
                            <span class="fileupload-exists">Change</span>
                            <input class="span12" type="file" name="image_path"/>
                        </label>
                        <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
