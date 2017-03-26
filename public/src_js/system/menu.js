/**
 * Created by erico on 10/17/16.
 */
$('#routes').select2({
    placeholder: 'Select Route'
});

$('#ed_routes').select2({
    placeholder: 'Select Route'
});

$('#parent_menu').select2({
    placeholder: 'Select Parent Menu'
});

$('#save-menu').on('click', function () {
    $('#menu-form').submit();
});

$('#delete-menu').on('click', function(){
    var items = $('input.checkbox:checked').length;
    if(items) {
        var ids = [];
        $('input.checkbox:checked').each(function () {
            ids.push($(this).val());
        });

        if(ids.length){
            var data = {
                ids: ids,
                _token: $('input[name="_token"]').val()
            };

            $.ajax({
                url: 'delete-menu',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function(data){
                    if(data.success){
                        location.reload();
                    }
                }
            });
        }
    }else{
        alert('You must select at least one record');
    }
});

$('.edit-menu-link').on('click', function () {
    var menu_id = $(this).attr('item-id');
    $('#edit_id').val(menu_id);

    if (menu_id != ''){
        $.ajax({
            url: 'get-menu/'+menu_id,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                $('#ed_routes').select2("val", data['route_id']);
                $('#icon').val(data['icon']);
                $('#menu_status').val(data['menu_status']);
            }
        });
    }
});