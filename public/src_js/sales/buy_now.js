/**
 * Created by erico on 11/4/16.
 */
var BuyNow = $('#buy-now').DataTable({
    processing: true,
    serverSide: true,
    ajax: 'load-buy-now-purchases',
    order: [[0, 'desc']],
    columns: [
        { data: 'id', 'name': 'id' },
        { data: 'sale_type_name', 'name': 'sale_type_name' },
        { data: 'sales_date', 'name': 'sales_date' },
        { data: 'customer_name', 'name': 'customer_name' },
        { data: 'transaction_id', 'name': 'transaction_id' },
        { data: 'cash_paid', 'name': 'cash_paid' },
        { data: 'item_name', 'name': 'item_name' }
    ]
});

$('#refresh').click(function(){
    BuyNow.ajax.reload();
});