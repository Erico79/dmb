<table id="my-bids" class="live_table table table-bordered">
    <thead>
        <tr>
            <th>bid#</th>
            <th>Item</th>
            <th>Price</th>
            <th>Bid Date</th>
            <th>End Time</th>
        </tr>
    </thead>
</table>
<input type="hidden" id="mf_id" value="{{ $mf->id }}"/>
@push('js')
    <script>
        var MyBids = $('#my-bids').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'my-bids/' + $('input#mf_id').val(),
            order: [[0, 'desc']],
            columns: [
                { data: 'bid_id', 'name': 'bid_id' },
                { data: 'item_name', 'name': 'item_name' },
                { data: 'bid_price', 'name': 'bid_price' },
                { data: 'bid_date', 'name': 'bid_date' },
                { data: 'new_endtime', 'name': 'new_endtime' }
            ]
        });
    </script>
@endpush