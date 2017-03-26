<div class="widget">
    <div class="widget-title">
        <h4><i class="icon-reorder"></i> Supplier Items</h4>
    </div>
    <div class="widget-body">
    <table class="table table-hover">
        <thead>
            <tr style="color:black; font-weight: bold;">
                <td>Item#</td>
                <td>Item Name</td>
                <td>Item Code</td>
                <td>Price</td>
                <td>Warehouse</td>
                <td>Status</td>
            </tr>
        </thead>
        <tbody>
            @if(count($items))
                @foreach($items as $item)
                    <?php
                    $warehouse_name = App\Warehouse::find($item->warehouse_id)?>
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->item_name }}</td>
                        <td>{{ $item->item_code }}</td>
                        <td>{{ $item->purchase_price }}</td>
                        <td>{{ $warehouse_name->warehouse_name }}</td>
                        <td>{{ ($item->item_status == 't') ? 'Active' : 'Inactive' }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
</div>