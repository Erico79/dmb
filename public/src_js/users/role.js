/**
 * Created by erico on 10/22/16.
 */
var roles = $('#roles-table').DataTable({
    processing: true,
    serverProcessing: true,
    order: [[0, 'desc']],
    ajax: 'all-roles',
    columns: [
        { data: 'id', 'name': 'id' },
        { data: 'role_name', 'name': 'role_name' },
        { data: 'role_code', 'name': 'role_code' },
        { data: 'role_status', 'name': 'role_status' },
        { data: 'user_mfid', 'name': 'user_mfid' },
        { data: 'created_at', 'name': 'created_at' },
        { data: 'manage', 'name': 'manage' }
    ]
});

var Role = {
    splash: function(type, content){
        switch(type){
            case 'success':
                var html = '<div class="alert alert-success">';
                html += '<button class="close" data-dismiss="alert">&times;</button>';
                html += '<strong>Success!</strong> '+content;
                html += '</div>';
                $('#feedback').html(html);
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
                $('#feedback').html(html);
                break;

            case 'error':
                var html = '<div class="alert alert-error">';
                html += '<button class="close" data-dismiss="alert">&times;</button>';
                html += '<strong>Error!</strong> '+content;
                html += '</div>';
                $('#feedback').html(html);
                break;
        }
    },
    close: function(type, content, modal){
        Role.splash(type, content);
        $(modal).modal('hide');
        roles.ajax.reload();
    }
}

$('#refresh-btn').click(function(){
   roles.ajax.reload();
});

$('#roles-table > tbody > tr').live('click', function(event){
    if(event.ctrlKey) {
        $(this).toggleClass('info');
    }
    else {
        if ( $(this).hasClass('info') ) {
            $('#roles-table > tbody > tr').removeClass('info');
        }
        else {
            $('#roles-table > tbody > tr').removeClass('info');
            $(this).toggleClass('info');
        }
    }
});

$('form#add_role_form').on('submit', function (e) {
    e.preventDefault();

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function (data) {
            if(data.success){
                Role.close('success', 'The role has been added', '#add-role');
            }else if(!data.success){
                Role.close('warning', data, '#add-role');
            }
        }
    });
});

$('#edit-role-btn').on('click', function(){
    var selected = $('tr.info').length;

    if(selected){
        if(selected > 1){
            alert('You can only edit one record at a time!');
            $(this).removeAttr('data-toggle');
            return false;
        }

        var ed_id = $('tr.info').find('td:first').text();
        $(this).attr({
            'data-toggle': 'modal',
            'edit-id': ed_id
        });
        $('#edit_id').val(ed_id);

        $.ajax({
            url: 'get-role/'+$(this).attr('edit-id'),
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                $('#role_name').val(data['role_name']);
                $('#role_code').val(data['role_code']);
                if(data['role_status'])
                    $('#role_status').val(1);
                else
                    $('#role_status').val(0);
            }
        });
    }else{
        alert('You must select a record first!');
        $(this).removeAttr('data-toggle');
    }
});

$('form#edit_role_form').on('submit', function (e) {
    e.preventDefault();

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function (data) {
            if(data.success){
                Role.close('success', 'The role has been updated', '#edit_role');
            }else if(!data.success){
                Role.close('warning', data, '#edit_role');
            }
        }
    });
});

// delete
$('#delete-role-btn').on('click', function(){
    var selected = $('tr.info').length;
    var ids = [];
    if(selected){
        $('tr.info').each(function(){
            ids.push($(this).find('td:first').text());
        });

        if(ids.length){
            $.ajax({
                url: 'delete-role',
                type: 'POST',
                data: {
                    ids: ids,
                    _token: $('form#add_role_form input[name="_token"]').val()
                },
                dataType: 'json',
                success: function (data) {
                    if(data.success){
                        Role.close('success', 'Successfully deleted', '');
                    }
                }
            });
        }
    }else{
        alert('You must select at least one record!');
    }
});

// manage
$(document).on('click', 'button.manage-btn', function(){
    // reset the checkboxes
    $('input:checkbox').removeAttr('checked').parent().removeClass('checked');

    var role_id = $(this).attr('role-id');
    // set the role id as then next role to be allocated views
    $('#nxt_role').val(role_id);
    var role_name = $(this).parent().parent().find('td:first').next().text();
    $('span#role_name79').text(role_name);

    if(role_id != ''){
        $('div.form-wizard ul > li:first').removeClass('active');
        $('div.form-wizard ul > li:first').next().addClass('active');
        var tab = $('div.form-wizard ul > li:first').next().find('a').attr('href');
        $(tab).addClass('active');
        $(tab).prev().removeClass('active');

        $.ajax({
            url: 'get-role-routes/'+role_id,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var allocated = data.length;
                if(allocated){
                    for(var i = 0; i < allocated; i++){
                        // check all the allocated routes
                        $('input:checkbox[value="'+data[i].route_id+'"]').attr('checked', 'checked').parent().addClass('checked');
                    }
                }
            }
        });
    }
});

// initiate nestable
var UINestable = function () {

    var updateOutput = function (e) {
        var list = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };


    return {
        //main function to initiate the module
        init: function () {

            // activate Nestable for list 1
            $('#nestable_list_1').nestable({
                group: 1
            }).on('change', updateOutput);

            // activate Nestable for list 2
            // $('#nestable_list_3').nestable({
            //     group: 1
            // })
            //     .on('change', updateOutput);

            // output initial serialised data
            updateOutput($('#nestable_list_1').data('output', $('#nestable_list_1_output')));
            // updateOutput($('#nestable_list_3').data('output', $('#nestable_list_2_output')));

            $('#nestable_list_menu').on('click', function (e) {
                var target = $(e.target),
                    action = target.data('action');
                if (action === 'expand-all') {
                    $('.dd').nestable('expandAll');
                }
                if (action === 'collapse-all') {
                    $('.dd').nestable('collapseAll');
                }
            });

            $('#nestable_list_3').nestable();

        }

    };

}();