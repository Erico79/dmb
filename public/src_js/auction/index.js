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
    $('#edit-auction-item').attr('data-toggle', 'modal');
    $('#delete-auction-item').attr('data-toggle', 'modal');

    //get attribute details and place then on the edit modal
    $.ajax({
        type: 'GET',
        url: 'auction-item-data/'+edit_id,
        dataType: 'json',
        success: function(data){
            $('#item').val(data['item_id']);
            if(data['auto_rollover'])
                $('#auto_rollover').val(1);
            else
                $('#auto_rollover').val(0);
            $('#reserve_price').val(data['reserve_price']);
            $('#bid_cost').val(data['bid_cost']);
            if(data['buy_now_option'])
                $('#buy_now_option').val(1);
            else
                $('#buy_now_option').val(0);
            $('#buy_now_price').val(data['buy_now_price']);
            $('#start_date').val(data['start_date']);
            $('#refresh_rate').val(data['refresh_rate']);
        }
    });
});

$('#edit-auction-item').on('click', function(){
    var edit_id = $('#edit_id').val();
    if(edit_id == ''){
        alert('You must select a record first!');
    }
});

$('#delete-auction-item').on('click', function(){
    var delete_id = $('#delete_id').val();
    if(delete_id == ''){
        alert('You must select a record first!');
    }
});