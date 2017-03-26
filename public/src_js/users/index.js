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
    $('#edit-user').attr('data-toggle', 'modal');
    $('#delete-user').attr('data-toggle', 'modal');

    //get attribute details and place then on the edit modal
    $.ajax({
        type: 'GET',
        url: 'service-data/'+edit_id,
        dataType: 'json',
        success: function(data){
            $('#status').val(data['status']);
        }
    });
});

$('#edit-user').on('click', function(){
    var edit_id = $('#edit_id').val();
    if(edit_id == ''){
        alert('You must select a record first!');
    }
});

$('#delete-user').on('click', function(){
    var delete_id = $('#delete_id').val();
    if(delete_id == ''){
        alert('You must select a record first!');
    }
});