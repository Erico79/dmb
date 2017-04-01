/**
 * Created by joel on 11/11/16.
 */
var customer = $('#all_suppliers').DataTable({
    processing: true,
    serverProcessing: true,
    order: [[0, 'desc']],
    ajax: 'load-suppliers', //loads data
    columns: [
        { data: 'id', 'name': 'id' },
        { data: 'full_name', 'name': 'full_name' },
        { data: 'email', 'name': 'email' },
        { data: 'b_role', 'name': 'b_role' },
        { data: 'customer_type_name', 'name': 'customer_type_name' },
        { data: 'reg_date', 'name': 'reg_date' },
        { data: 'profile', 'name': 'profile' },
    ]
});

$('#search_supplier').on('input', function(){
    var key = $(this).val();

    customer.ajax.url('load-suppliers?key=' + key).load();
});