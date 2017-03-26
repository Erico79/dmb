{{--<form action="{{ url('/profile-settings/change-password/'.$us->id) }}" method="post" id="change-pass">--}}
    {{ csrf_field() }}
    @include('layouts.includes._messages')
    <div class="row-fluid">
        <div class="span6">
            <div class="control-group">
                <label for="oldpassword" class="control-label"> Old Password:</label>
                <div class="controls  input-icon">
                    <input type="password" name="oldpassword" class="span12"/>
                </div>
            </div>
        </div>
        <div class="span6">
            <div class="control-group">
                <label class="control-label" for="password">New Password</label>
                <div class="controls">
                    <input type="password" name="password" class="span12"/>
                </div>
            </div>
        </div>
    </div>

    <div class="row-fluid">
        <div class="span6">
            <div class="control-group">
                <label for="pass_again" class="control-label">Confirm Password</label>
                <div class="controls">
                    <input type="password" name="pass_again" class="span12" />
                </div>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <button class="btn btn-success button-submit">Save</button>
    </div>
{{--</form>--}}