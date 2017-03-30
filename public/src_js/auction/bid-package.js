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
    $('#edit-bid-package').attr('data-toggle', 'modal');
    $('#delete-bid-package').attr('data-toggle', 'modal');

    //get attribute details and place then on the edit modal
    $.ajax({
        type: 'GET',
        url: 'bid-package-data/'+edit_id,
        dataType: 'json',
        success: function(data){
            $('#package_name').val(data['package_name']);
            $('#service').val(data['service_channel_id']);
            $('#no_of_tockens').val(data['no_of_tockens']);
            $('#price').val(data['price']);
            $('#item').select2("val", (data['item_id']));
        }
    });
});

$('#edit-bid-package').on('click', function(){
    var edit_id = $('#edit_id').val();
    if(edit_id == ''){
        alert('You must select a record first!');
    }
});

$('#delete-bid-package').on('click', function(){
    var delete_id = $('#delete_id').val();
    if(delete_id == ''){
        alert('You must select a record first!');
    }
});