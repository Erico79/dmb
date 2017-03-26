/**
 * Created by erico on 11/7/16.
 */
var Orders = $('#orders').DataTable({
    processing: true,
    serverSide: true,
    ajax: 'load-orders',
    order: [[0, 'desc']],
    columns: [
        { data: 'order_id', 'name': 'order_id' },
        { data: 'order_date', 'name': 'order_date' },
        { data: 'user_mfid', 'name': 'user_mfid' },
        { data: 'status', 'name': 'status' },
        { data: 'view_orders', 'name': 'view_orders', orderable: false, searchable: false }
    ]
});

$('#refresh').click(function(){
    Orders.ajax.reload();
});

$(document).on('click', 'button.view-orders', function () {
    var order_id = $(this).attr('order-id');
    $('#order_id').text(order_id);

    // loading...
    var html = '<tr>';
    html += '<td colspan="5" style="text-align: center;">Loading...</td>';
    html += '</tr>';
    $('tbody#order-details').html(html);

    if(order_id){
        // ajax to retrieve all order items
        $.ajax({
            url: 'load-order-items/'+order_id,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var count = data.length;
                var html = '';
                if(count){
                    for (var i = 0; i < count; i++){
                        // load all the items on the grid
                        html += '<tr>';
                        html += '<td>'+data[i].id+'</td>';
                        html += '<td>'+data[i].item_name+'</td>';
                        html += '<td>'+data[i].quantity+'</td>';
                        html += '<td>'+data[i].price+'</td>';
                        html += '<td>'+data[i].subtotal+'</td>';
                        html += '</tr>';
                    }
                    $('tbody#order-details').html(html);
                }else{
                    var html = '<tr>';
                    html += '<td colspan="5" style="text-align: center;">No items found!</td>';
                    html += '</tr>';
                    $('tbody#order-details').html(html);
                }
            }
        });
    }
});