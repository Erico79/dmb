$('.restore_mf').on('click', function(){
    var id = $(this).attr('id');
    var data = { 'id': id }

    if(id != ''){
        //perform some ajax to restore masterfile and reactivate login account
        $.ajax({
            url: 'restore-mf',
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(data){
                console.log(data)
                if(data['status'] = 1){
                    $('#flash').slideDown('slow', function(){
                        location.reload(true);
                    });
                }else{
                    alert('Encountered an error!');
                }
            }
        });
    }
});

// refresh button

$('#refresh-btn').click(function(){
    //alert('working');
    location.reload();
});

$('.delete_mf').on('click',function(){
    if(!confirm('Are you Sure you want to permanently delete the masterfile record?')){
        return false;
    }
});