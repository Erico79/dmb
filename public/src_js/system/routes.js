var Route = {
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
    loadRoutes: function(){
        $.ajax({
            url: 'get-routes',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var options = '<option value="">--No Parent--</option>';
                if(data.length){
                    for (var i = 0; i < data.length; i++){
                        options += '<option value="'+data[i].id+'">'+data[i].route_name+'</option>';
                    }
                    $('select#parent_route, select#ed_parent_route').html(options);
                }
            }
        })
    },
    resetFields: function(){
        $('input[type="number"], input[type="text"], input[type="email"], textarea').val('');
        $("#parent_route").select2("val", "");
    }
};

// on row click
$('#routes > tbody > tr').live('click', function(event){
    if(event.ctrlKey) {
        $(this).toggleClass('info');
    }
    else {
        if ( $(this).hasClass('info') ) {
            $('#routes > tbody > tr').removeClass('info');
        }
        else {
            $('#routes > tbody > tr').removeClass('info');
            $(this).toggleClass('info');
        }
    }
});

$('#edit-route-btn').on('click', function(){
    var records = $('tr.info').length;

    if(records == 1){
        $(this).attr('data-toggle', 'modal');
        var edit_id = $('tr.info').find('td:first').text();

        if(edit_id){
            $.ajax({
                url: 'get-route/'+edit_id,
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    $('#route_name').val(data['route_name']);
                    $('#url').val(data['url']);
                    $('#ed_parent_route').select2("val", data['parent_route']);
                    $('#route_status').val(data['route_status']);
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

// load Parent Routes
Route.loadRoutes();

var routes = $('#routes').DataTable({
    processing: true,
    serverSide: false,
    order: [[ 0, "desc" ]],
    ajax: 'load-routes',
    columns: [
        { data: 'id', 'name': 'id' },
        { data: 'route_name', 'name': 'route_name' },
        { data: 'url', 'name': 'url' },
        { data: 'parent_route', 'name': 'parent_route' },
        { data: 'route_status', 'name': 'route_status' }
    ]
});

$('#refresh-routes').on('click', function(){
    routes.ajax.reload();
});

// add route
$('#add-route-form').on('submit', function (e) {
    e.preventDefault();

    $.ajax({
        url: 'add-route',
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(data){
            if(data.success){
                // load Parent Routes
                Route.loadRoutes();

                // reset fields
                Route.resetFields();

                // close modal
                $('#add-route').modal('hide');

                // alert success
                var success = Route.splash('success', 'The route has been added!');
                $('#feedback').html(success);

                // reload grid
                routes.ajax.reload();

                //remove alert after 3 seconds
                setTimeout(function(){
                    $('#feedback').slideUp('slow');
                }, 3000);
            }else if(!data.success){
                // show errors
                $('#add-route').modal('hide');

                // alert errors
                var warnings = Route.splash('warning', data);
                $('#feedback').html(warnings);
            }
        }
    });
});

// update route
$('#edit-route-form').on('submit', function (e) {
    e.preventDefault();

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: {
            route_name: $('#route_name').val(),
            url: $('#url').val(),
            route_status: $('#route_status').val(),
            parent: $('#ed_parent_route').val(),
            _token: $('input[name="_token"]').val(),
            id: $('tr.info').find('td:first').text()
        },
        dataType: 'json',
        success: function(data){
            if(data.success){
                // load Parent Routes
                Route.loadRoutes();

                // close modal
                $('#edit-route').modal('hide');

                // alert success
                var success = Route.splash('success', 'The route has been updated!');
                $('#feedback').html(success);

                // reload grid
                routes.ajax.reload();

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

$('#delete-route-btn').on('click', function(){
     var records = $('tr.info').length;
     if(records) {
         if (confirm('Are you sure you want to delete the selected record(s)?')) {
             var ids = [];
             $('tr.info').each(function () {
                 ids.push($(this).find('td:first').text());
             });

             if (ids.length) {
                 $.ajax({
                     url: 'delete-route',
                     type: 'POST',
                     data: {
                         ids: ids,
                         _token: $('input[name="_token"]').val()
                     },
                     dataType: 'json',
                     success: function (data) {
                         if (data.success) {
                             // load Parent Routes
                             Route.loadRoutes();

                             // alert success
                             var success = Route.splash('success', 'Successfully deleted!');
                             $('#feedback').html(success);

                             // reload grid
                             routes.ajax.reload();

                             //remove alert after 3 seconds
                             setTimeout(function(){
                                 $('#feedback').slideUp('slow');
                             }, 3000);
                         } else if (!data.success) {
                             var error = Route.splash('warnings', 'Failed to delete the selected record(s)');
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

$('#parent_route').select2({
    placeholder: 'Select a Parent Route'
});

$('#ed_parent_route').select2({
    placeholder: 'Select a Parent Route'
});