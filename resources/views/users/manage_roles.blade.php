{{--actions--}}
<button class="btn btn-primary btn-small" data-toggle="modal" data-target="#add-role"><i class="icon-plus"></i> Add</button>
<button class="btn btn-warning btn-small" data-target="#edit_role" id="edit-role-btn"><i class="icon-edit"></i> Edit</button>
<button class="btn btn-danger btn-small" id="delete-role-btn"><i class="icon-trash"></i> Delete</button>
<button id="refresh-btn" class="btn btn-info btn-small"><i class="icon-refresh"></i> Refresh</button>
<br><br>

<div id="feedback"></div>
<table id="roles-table" class="table table-bordered">
    <thead>
        <tr>
            <th>Role#</th>
            <th>Name</th>
            <th>Code</th>
            <th>Status</th>
            <th>Created By</th>
            <th>Created</th>
            <th>Manage</th>
        </tr>
    </thead>
</table>

{{--modals--}}
<form action="{{ url('/add-role') }}" method="post" id="add_role_form">
    {{ csrf_field() }}
    <div id="add-role" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel1">Add Role</h3>
        </div>
        <div class="modal-body">
            <div class="row-fluid">
                <label for="role_name">Role Name:</label>
                <input type="text" name="role_name" class="span12" required/>
            </div>

            <div class="row-fluid">
                <label for="role_code">Role Code:</label>
                <input type="text" name="role_code" class="span12" required/>
            </div>

            <div class="row-fluid">
                <label for="role_status">Role status:</label>
                <select name="role_status" class="span12" required>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default" value="Close" data-dismiss="modal">
            <input type="submit" class="btn btn-primary" value="Save">
        </div>
    </div>
</form>

<form action="{{ url('/edit-role') }}" method="post" id="edit_role_form">
    {{ csrf_field() }}
    <div id="edit_role" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel1">Add Role</h3>
        </div>
        <div class="modal-body">
            <div class="row-fluid">
                <label for="role_name">Role Name:</label>
                <input type="text" name="role_name" id="role_name" class="span12" required/>
            </div>

            <div class="row-fluid">
                <label for="role_code">Role Code:</label>
                <input type="text" name="role_code" id="role_code" class="span12" required/>
            </div>

            <div class="row-fluid">
                <label for="role_status">Role status:</label>
                <select name="role_status" class="span12" id="role_status" required>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        </div>

        {{--hidden fields--}}
        <input type="hidden" id="edit_id" name="edit_id"/>
        <div class="modal-footer">
            <input type="button" class="btn btn-default" value="Close" data-dismiss="modal">
            <input type="submit" class="btn btn-primary" value="Save">
        </div>
    </div>
</form>

@push('js')
    <script src="{{ URL::asset('src_js/users/role.js') }}"></script>
@endpush