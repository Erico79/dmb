/**
 * Created by alex on 02/10/16.
 */
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
// $('#table1').on('click', 'tr', function() {
//     edit_id = $(this).children('td:first').text();
//
// });



$('.edit_cat').on('click',function () {
    var action = $(this).attr('action');
    var id = $(this).attr('edit-id');
    $('#edit-cat-form').attr('action','');
    if( id != '') {
        $('#route-id').val(id);
        // var e_id = $('#route-id').val();
        // alert(action);
        $('#edit-cat-form').attr('action', action);

        $.ajax({
            url: 'category-details/' + id,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                // alert(data['category_name']);
                $('#cat-name').val(data['category_name']);
                $('#cat-code').val(data['category_code']);
                $('#cat-status').val(data['category_status']);
            }
        })
    }
});

$('.delete_category').on('click',function(){
    if(!confirm('Are you Sure you want to delete the category?')){
        return false;
    }
});