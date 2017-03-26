
$('.edit_address').on('click', function(){
    $('#edit-address-form').attr('action','');
    var edit_id = $(this).attr('edit-id');
    var action = $(this).attr('action');
    if(edit_id != ''){
        $('#edit-address-form').attr('action',action);
        // ajax
        $.ajax({
            url: 'address-data/'+edit_id,
            type: 'GET',
            dataType: 'json',
            success: function(data){
                $('#county').val(data['county']);
                $('#town').val(data['town']);
                $('#address_type_name').val(data['address_type_name']);
                $('#postal_address').val(data['postal_address']);
                $('#postal_code').val(data['postal_code']);
                $('#ward').val(data['ward']);
                $('#street').val(data['street']);
                $('#building').val(data['building']);
                $('#phone').val(data['phone']);
            }
        });
    }
});

$('.delete_address').on('click', function(){
    if(confirm('Are you sure you want to delete the selected Address?')){
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