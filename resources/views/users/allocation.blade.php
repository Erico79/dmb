@push('css')
    <link href="{{ URL::asset('src_js/pnotify/pnotify.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('src_js/pnotify/animate.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('src_js/pnotify/pnotify.brighttheme.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('src_js/pnotify/pnotify.buttons.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('js')
    {{--pnotify script files--}}
    <script type="text/javascript" src="{{ URL::asset('src_js/pnotify/pnotify.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('src_js/pnotify/pnotify.buttons.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('src_js/pnotify/pnotify.animate.js') }}"></script>

    <script>
        UINestable.init();

        $('input:checkbox').click(function(){
            var checked = $(this).is(':checked');
            var route_id = $(this).val();
            var role = $('#nxt_role').val();

            // prepare the data
            var data = {
                _token: $('input[name="_token"]').val(),
                route: route_id,
                role: role
            };

            // attach or detach based on the user demand
            if(checked){
                if(route_id != ''){
                    $.ajax({
                        url: 'attach-to-role',
                        type: 'POST',
                        data: data,
                        dataType: 'json',
                        success: function (data) {
                            if(data.success){
                                // do a success pnotify
                                new PNotify({
                                    title: 'Attached',
                                    text: 'Route has been allocated',
                                    type: 'success',
                                    buttons: {
                                        closer_hover: false,
                                        sticker_hover: false
                                    },
                                    animate: {
                                        animate: true,
                                        in_class: 'rotateInDownLeft',
                                        out_class: 'rotateOutUpRight'
                                    }
                                });
                            }else if(!data.success){
                                // do a fail pnotify
                                new PNotify({
                                    title: 'Warning',
                                    text: data.message,
                                    type: 'error',
                                    buttons: {
                                        closer_hover: false,
                                        sticker_hover: false
                                    },
                                    animate: {
                                        animate: true,
                                        in_class: 'rotateInDownLeft',
                                        out_class: 'rotateOutUpRight'
                                    }
                                });
                            }
                        }
                    });
                }
            }else{
                if(route_id != ''){
                    $.ajax({
                        url: 'detach-from-role',
                        type: 'POST',
                        data: data,
                        dataType: 'json',
                        success: function (data) {
                            if(data.success){
                                // do a success pnotify
                                new PNotify({
                                    title: 'Detached',
                                    text: 'Route has been detached',
                                    type: 'success',
                                    buttons: {
                                        closer_hover: false,
                                        sticker_hover: false
                                    },
                                    animate: {
                                        animate: true,
                                        in_class: 'rotateInDownLeft',
                                        out_class: 'rotateOutUpRight'
                                    }
                                });
                            }else{
                                // do a fail pnotify
                                new PNotify({
                                    title: 'Warning',
                                    text: data.message,
                                    type: 'error',
                                    buttons: {
                                        closer_hover: false,
                                        sticker_hover: false
                                    },
                                    animate: {
                                        animate: true,
                                        in_class: 'rotateInDownLeft',
                                        out_class: 'rotateOutUpRight'
                                    }
                                });
                            }
                        }
                    });
                }
            }
        });

        $('.load-actions-link').on('click', function () {
            var route_id = $(this).attr('item-id');
            var role_id = $('#nxt_role').val();
            var loading = '<tr>';
            loading += '<td colspan="4" style="text-align: center;">Loading...</td>';
            loading += '</tr>';
            $('tbody#action_data').html(loading);

            if(route_id != ''){
                $.ajax({
                    url: 'load-actions/'+route_id+'/'+role_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        var count = data.length;
                        var html = '';
                        if(count){
                            for (var i = 0; i < count; i++){
                                html += '<tr>';
                                html += '<td>'+data[i].action_name+'</td>';
                                html += '<td>'+data[i].action_code+'</td>';
                                if(data[i].action_status)
                                    html += '<td><label class="label label-success">Active</label></td>';
                                else
                                    html += '<td><label class="label label-warning">Inactive</label></td>';
                                if(!data[i].attached) {
                                    html += '<td><button class="btn btn-mini btn-info attach-action" action-id="' + data[i].id + '"><i class="icon-paper-clip"></i> Attach</button></td>';
                                }else{
                                    html += '<td><button class="btn btn-mini btn-danger detach-action" action-id="' + data[i].id + '"><i class="icon-remove"></i> Detach</button></td>';
                                }
                                html += '</tr>';
                            }
                        }else{
                            html += '<tr><td colspan="4" style="text-align: center;">No Actions for this route!</td></tr>';
                        }
                        $('tbody#action_data').html(html);
                    }
                });
            }
        });

        $(document).on('click', '.attach-action', function(){
            var action_id = $(this).attr('action-id');
            var role_id = $('#nxt_role').val();

            var this_data = $(this);
            if(role_id != '' && action_id != ''){
                $.ajax({
                    url: 'attach-action',
                    type: 'POST',
                    data: {
                        _token: $('input[name="_token"]').val(),
                        role_id: role_id,
                        action_id: action_id
                    },
                    dataType: 'json',
                    success: function (data) {
                        if(data.success){
                            new PNotify({
                                title: 'Action Attached',
                                text: 'Action has been allocated',
                                type: 'success',
                                buttons: {
                                    closer_hover: false,
                                    sticker_hover: false
                                },
                                animate: {
                                    animate: true,
                                    in_class: 'rotateInDownLeft',
                                    out_class: 'rotateOutUpRight'
                                }
                            });

                            var detach = '<i class="icon-remove"></i> Detach';
                            console.log($(this));
                            this_data.removeClass('attach-action btn-info').addClass('detach-action btn-danger').html(detach);
                        }
                    }
                });
            }
        });

        $(document).on('click', '.detach-action', function(){
            var action_id = $(this).attr('action-id');
            var role_id = $('#nxt_role').val();

            var this_data = $(this);
            if(role_id != '' && action_id != ''){
                $.ajax({
                    url: 'detach-action',
                    type: 'POST',
                    data: {
                        _token: $('input[name="_token"]').val(),
                        role_id: role_id,
                        action_id: action_id
                    },
                    dataType: 'json',
                    success: function (data) {
                        if(data.success){
                            new PNotify({
                                title: 'Action Detached',
                                text: 'Action has been detached',
                                type: 'success',
                                buttons: {
                                    closer_hover: false,
                                    sticker_hover: false
                                },
                                animate: {
                                    animate: true,
                                    in_class: 'rotateInDownLeft',
                                    out_class: 'rotateOutUpRight'
                                }
                            });

                            var attach = '<i class="icon-paper-clip"></i> Attach';
                            this_data.removeClass('detach-action btn-danger').addClass('attach-action btn-info').html(attach);
                        }
                    }
                });
            }
        });
    </script>
@endpush

{{--hidden field ya serialized--}}
<input type="hidden" id="nestable_list_1_output" class="m-wrap span12"/>
<input type="hidden" id="nxt_role"/>
{{ csrf_field() }}

<div class="widget-body">
    <div class="dd" id="nestable_list_1">
        <?php
            $role = new \App\Http\Controllers\UserRoleController;
            $role->getRoutes(NULL);
        ?>
    </div>
</div>

{{--role id--}}
<div id="load_actions" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel1">Allocate Actions to <span class=""></span></h3>
    </div>
    <div class="modal-body">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Action Name</th>
                    <th>Action Code</th>
                    <th>Action Status</th>
                    <th>Attach/Detach</th>
                </tr>
            </thead>
            <tbody id="action_data"></tbody>
        </table>
    </div>
</div>