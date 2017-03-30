$('.delete_warehouse').on('click', function(){
    if(confirm('Are you sure you want to delete the selected warehouse?')){
        return true;
    }else{
        return false;
    }
});

$('#table1 > tbody > tr').live('click', function(event){
    if(event.ctrlKey) {
        $(this).toggleClass('info');
    }
    else {
        if ( $(this).hasClass('info') ) {
            $('#table1 > tbody > tr').removeClass('info');
        }
        else {
            $('#table1 > tbody > tr').removeClass('info');
            $(this).toggleClass('info');
        }
    }
});

$('.edit_warehouse').on('click', function(){
    $('#edit-warehouse-form').attr('action','');
    var edit_id = $(this).attr('edit-id');
    var action = $(this).attr('action');
    if(edit_id != ''){
        $('#edit-warehouse-form').attr('action',action);
        // ajax
        $.ajax({
            url: 'warehouse-data/'+edit_id,
            type: 'GET',
            dataType: 'json',
            success: function(data){
                $('#warehouse_code').val(data['warehouse_code']);
                $('#warehouse_name').val(data['warehouse_name']);
                if(data['warehouse_status'])
                    $('#warehouse_status').val(1);
                else
                    $('#warehouse_status').val(0);
            }
        });
    }
});