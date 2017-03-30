$('.profile').on('click', function () {
    var id = $(this).attr('profile-id');
    $.ajax({
        type:'GET',
        url: 'item-details/'+id,
        dataType: 'json',
        success: function (data) {
            $('#item-name').text(data['item_name']);
        }
    });
})