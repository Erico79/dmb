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

//get the ailment id
$('#table1').on('click', 'tr', function() {
    edit_id = $(this).children('td:first').text();
    $('#edit_id').val(edit_id);
    $('#delete_id').val(edit_id);

    //prepare to show the dialog
    $('#edit-sc').attr('data-toggle', 'modal');
    $('#del-sc').attr('data-toggle', 'modal');

    //get attribute details and place then on the edit modal
    $.ajax({
        type: 'GET',
        url: 'service-data/'+edit_id,
        dataType: 'json',
        success: function(data){
            $('#revenue_channel').val(data['revenue_channel_id']);
            $('#service_option').val(data['service_option']);
            $('#option_code').val(data['option_code']);
            $('#option_type').val(data['service_option_type']);
            $('#parent').val(data['parent_id']);
            $('#price').val(data['price']);
            $('#request_type').val(data['request_type_id']);
            $('#status').val(data['status']);
        }
    });
});

$('#edit-sc').on('click', function(){
    var edit_id = $('#edit_id').val();
    if(edit_id == ''){
        alert('You must select a record first!');
    }
});

$('#del-sc').on('click', function(){
    var delete_id = $('#delete_id').val();
    if(delete_id == ''){
        alert('You must select a record first!');
    }
});