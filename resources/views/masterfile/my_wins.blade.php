<table id="my-purchase" class="live_table table table-bordered">
    <thead>
    <tr>
        <th>Item#</th>
        <th>Item Name</th>
        <th>Bid Cost</th>
        <th>Date</th>
    </tr>
    </thead>
</table>
<input type="hidden" id="mf_id" value="{{ $mf->id }}"/>
@push('js')
<script>
    var MyPurchase = $('#my-purchase').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'my-purchase/' + $('input#mf_id').val(),
        order: [[0, 'desc']],
        columns: [
            { data: 'id', 'name': 'id' },
            { data: 'item_name', 'name': 'item_name' },
            { data: 'buy_now_price', 'name': 'buy_now_price' },
            { data: 'end_date', 'name': 'end_date' }
        ]
    });
</script>
@endpush