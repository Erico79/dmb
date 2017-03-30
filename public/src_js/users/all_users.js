var users = {
    splash: function(type, content, modal){
        switch(type){
            case 'success':
                var html = '<div class="alert alert-success">';
                html += '<button class="close" data-dismiss="alert">&times;</button>';
                html += '<strong>Success!</strong> '+content;
                html += '</div>';
                return html;
                break;

            case 'warning':
                var html = '<div class="alert alert-warning">';
                html += '<button class="close" data-dismiss="alert">&times;</button>';
                html += '<strong>Warnings!</strong> ';

                for(var key in content.errors) {
                    var errors = content.errors[key];
                    for(var i = 0; i < errors.length; i++){
                        html += '<li>'+errors[i]+'</li>';
                    }
                }

                html += '</div>';
                return html;
                break;

            case 'error':
                var html = '<div class="alert alert-error">';
                html += '<button class="close" data-dismiss="alert">&times;</button>';
                html += '<strong>Error!</strong> '+content;
                html += '</div>';
                return html;
                break;
        }
    },
    resetFields: function(){
        $('input[type="number"], input[type="text"], input[type="email"], textarea').val('');
        $("#all_users").select2("val", "");
    }
};

var User = $('#all_users').DataTable({
    processing: true,
    serverProcessing: true,
    order: [[0, 'desc']],
    ajax: 'load-users',
    columns: [
        { data: 'id', 'name': 'id' },
        { data: 'user_name', 'name': 'user_name' },
        { data: 'email', 'name': 'email' },
        { data: 'status', 'name': 'status' },
        { data: 'user_role', 'name': 'user_role' },
        { data: 'created_at', 'name': 'created_at' },
        { data: 'manage', 'name': 'manage', orderable: false, searchable: false},
        { data: 'profile', 'name': 'profile', orderable: false, searchable: false}
    ]
});

$('#refresh-btn').click(function(){
    User.ajax.reload();
});

$('#all_users > tbody > tr').live('click', function(event){
    if(event.ctrlKey) {
        $(this).toggleClass('info');
    }
    else {
        if ( $(this).hasClass('info') ) {
            $('#all_users > tbody > tr').removeClass('info');
        }
        else {
            $('#all_users > tbody > tr').removeClass('info');
            $(this).toggleClass('info');
        }
    }
});

$('#delete-user-btn').on('click', function(e){
    e.preventDefault();
    var records = $('tr.info').length;
    if(records) {
        if (confirm('Are you sure you want to delete the selected record(s)?')) {
            var ids = [];
            $('tr.info').each(function () {
                ids.push($(this).find('td:first').text());
            });
               
            if (ids.length) {
                $.ajax({
                    url: 'delete-user',
                    type: 'POST',
                    data: {
                        ids: ids,
                        _token: $('input[name="_token"]').val()
                    },
                    dataType: 'json',
                    success: function (data) {
                        if (data.success) {
                            // alert success
                            var success = users.splash('success', 'Successfully deleted!');
                            $('#feedback').html(success);

                            // reload grid
                            User.ajax.reload();

                            //remove alert after 3 seconds
                            setTimeout(function(){
                                $('#feedback').slideUp('slow');
                            }, 3000);
                        } else if (!data.success) {
                            var error = users.splash('warnings', 'Failed to delete the selected record(s)');
                            $('#feedback').html(error);
                        }
                    }
                });
            }
        }
    }else{
        alert('You must select at least one record!');
    }
});

$('#reset-pass-btn').on('click', function(e){
    e.preventDefault();
    var records = $('tr.info').length;

    if(records == 1){
        if (confirm('Are you sure you want to Reset the Password?')) {
            $(this).attr('data-toggle', 'modal');
            var edit_id = $('tr.info').find('td:first').text();
            //alert(edit_id);
            if (edit_id) {
                $.ajax({
                    url: 'reset-pass',
                    type: 'POST',
                    data: {
                        id: edit_id,
                        _token: $('input[name="_token"]').val()
                    },
                    dataType: 'json',
                    success: function (data) {
                        //alert(data.success);
                        if (data.success) {
                            // alert success
                            var success = users.splash('success', 'Password Reset Successfully!please check your email for your new credentials');
                             $('#feedback').html(success);
                            // reload grid
                            User.ajax.reload();

                            //remove alert after 3 seconds
                            setTimeout(function(){
                                $('#feedback').slideUp('slow');
                            }, 4000);
                        } else if (!data.success) {
                            var error = users.splash('warnings', 'Failed to reset the password');
                            $('#feedback').html(error);
                        }
                    }
                });
            }
        }
    }else{
        alert('You must select at least one record!');
    }
});

$(document).on('click', '#block', function(){
    var user_id = $(this).attr('user-id');
    $status = '0';
    // alert($status);
    var this_data = $(this);
    if(user_id != ''){
        $.ajax({
            url: 'block-user',
            type: 'POST',
            data: {
                _token: $('input[name="_token"]').val(),
                id: user_id,
                status: $status
            },
            dataType: 'json',
            success: function (data) {
                if(data.success){
                    //alert(data.success);
                    if (data.success) {
                        // alert success
                        var success = users.splash('success', 'User Account has been  Deactivated Successfully!');
                        $('#feedback').html(success);
                        // reload grid
                        User.ajax.reload();

                        //remove alert after 3 seconds
                        setTimeout(function(){
                            $('#feedback').slideUp('slow');
                        }, 4000);
                    } else if (!data.success) {
                        var error = users.splash('warnings', 'Failed to Deactivate the User account');
                        $('#feedback').html(error);
                    }
                }
            }
        });
    }
});

$(document).on('click', '#unblock', function(){
    var user_id = $(this).attr('user-id');
    $status = '1';
    // alert($status);
    var this_data = $(this);
    if(user_id != ''){
        $.ajax({
            url: 'unblock-user',
            type: 'POST',
            data: {
                _token: $('input[name="_token"]').val(),
                id: user_id,
                status: $status
            },
            dataType: 'json',
            success: function (data) {
                if(data.success){
                    //alert(data.success);
                    if (data.success) {
                        // alert success
                        var success = users.splash('success', 'User Account has been Activated Successfully!');
                        $('#feedback').html(success);
                        // reload grid
                        User.ajax.reload();

                        //remove alert after 3 seconds
                        setTimeout(function(){
                            $('#feedback').slideUp('slow');
                        }, 4000);
                    } else if (!data.success) {
                        var error = users.splash('warnings', 'Failed to activate the User account');
                        $('#feedback').html(error);
                    }
                }
            }
        });
    }
});