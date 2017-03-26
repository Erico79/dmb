var Sys_action = {
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
    loadActions: function(){
        $.ajax({
            url: 'get-child-routes',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var options = '<option value="">--Select Route--</option>';
                if(data.length){
                    for (var i = 0; i < data.length; i++){
                        options += '<option value="'+data[i].id+'">'+data[i].route_name+'</option>';
                    }
                    $('select#sys_route, select#ed_sys_route').html(options);
                }
            }
        })
    },
    resetFields: function(){
        $('input[type="number"], input[type="text"], input[type="email"], textarea').val('');
        $("#sysaction").select2("val", "");
    }
};

// on row click
$('#sysaction > tbody > tr').live('click', function(event){
    if(event.ctrlKey) {
        $(this).toggleClass('info');
    }
    else {
        if ( $(this).hasClass('info') ) {
            $('#sysaction > tbody > tr').removeClass('info');
        }
        else {
            $('#sysaction > tbody > tr').removeClass('info');
            $(this).toggleClass('info');
        }
    }
});

$('#edit-action-btn').on('click', function(){
    var records = $('tr.info').length;

    if(records == 1){
        $(this).attr('data-toggle', 'modal');
        var edit_id = $('tr.info').find('td:first').text();

        if(edit_id){
            $.ajax({
                url: 'get-action/'+edit_id,
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    $('#action_name').val(data['action_name']);
                    $('#action_description').val(data['action_description']);
                    $('#action_class').val(data['action_class']);
                    $('#ed_sys_route').select2("val", data['route_id']);
                    $('#action_status').val(data['action_status']);
                    $('#action_type').val(data['action_type']);
                    $('#action_category').val(data['action_category']);
                    $('#attributes').val(data['attributes']);
                    $('#icon').val(data['icon']);
                }
            });
        }
    }else if(records > 1) {
        $(this).removeAttr('data-toggle');
        alert('You can only edit one record at a time!');
    }else{
        $(this).removeAttr('data-toggle');
        alert('You must select a record first!');
    }
});

// load Actions
Sys_action.loadActions();

var actions = $('#sysaction').DataTable({
    processing: true,
    serverSide: true,
    order: [[ 0, "desc" ]],
    ajax: 'load-action',
    columns: [
        { data: 'id', 'name': 'id' },
        { data: 'action_name', 'name': 'action_name' },
        { data: 'action_code', 'name': 'action_code' },
        { data: 'route_name', 'name': 'route_name' },
        { data: 'action_status', 'name': 'action_status' },
        { data: 'user_name', 'name': 'user_name' }

    ]
});

$('#refresh-actions').on('click', function(){
    actions.ajax.reload();
});

// add route
$('#add-sysaction-form').on('submit', function (e) {
    e.preventDefault();

    $.ajax({
        url: 'add-action',
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(data){
            if(data.success){
                // load Parent Routes
                Sys_action.loadActions();

                // reset fields
                Sys_action.resetFields();

                // close modal
                $('#add-sysaction').modal('hide');

                // alert success
                var success = Sys_action.splash('success', 'The route Action has been added!');
                $('#feedback').html(success);

                // reload grid
                actions.ajax.reload();

                //remove alert after 3 seconds
                setTimeout(function(){
                    $('#feedback').slideUp('slow');
                }, 3000);
            }else if(!data.success){
                // show errors
                $('#add-sysaction').modal('hide');

                // alert errors
                var warnings = Sys_action.splash('warning', data);
                $('#feedback').html(warnings);
            }
        }
    });
});

// update route
$('#edit-sysaction-form').on('submit', function (e) {
    e.preventDefault();

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(data){
            if(data.success){
                // load Parent Routes
                Sys_action.loadActions();

                // close modal
                $('#edit-sysaction').modal('hide');

                // alert success
                var success = Sys_action.splash('success', 'The route action has been updated!');
                $('#feedback').html(success);

                // reload grid
                actions.ajax.reload();

                //remove alert after 3 seconds
                setTimeout(function(){
                    $('#feedback').slideUp('slow');
                }, 3000);
            }else if(!data.success){
                // show errors
            }
        }
    });
});

$('#delete-action-btn').on('click', function(){
    var records = $('tr.info').length;
    if(records) {
        if (confirm('Are you sure you want to delete the selected record(s)?')) {
            var ids = [];
            $('tr.info').each(function () {
                ids.push($(this).find('td:first').text());
            });

            if (ids.length) {
                $.ajax({
                    url: 'delete-action',
                    type: 'POST',
                    data: {
                        ids: ids,
                        _token: $('input[name="_token"]').val()
                    },
                    dataType: 'json',
                    success: function (data) {
                        if (data.success) {
                            // load Parent Routes
                            Sys_action.loadActions();

                            // alert success
                            var success = Sys_action.splash('success', 'Successfully deleted!');
                            $('#feedback').html(success);

                            // reload grid
                            actions.ajax.reload();

                            //remove alert after 3 seconds
                            setTimeout(function(){
                                $('#feedback').slideUp('slow');
                            }, 3000);
                        } else if (!data.success) {
                            var error = Sys_action.splash('warnings', 'Failed to delete the selected record(s)');
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

$('#sys_route').select2({
    placeholder: 'Select a Route'
});

$('#ed_sys_route').select2({
    placeholder: 'Select a Route'
});