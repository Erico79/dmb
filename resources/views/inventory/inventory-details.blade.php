<!-- BEGIN FORM -->
    <div class="row-fluid">
        <div class="span6">
            <div class="control-group">
                <label for="county" class="control-label">Supplier</label>
                <div class="controls">
                    <select name="masterfile-id" class="span12 live_search" id="select2_sample79" >
                        <option value="">--Select supplier--</option>
                        @if(count($suppliers))
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->surname.' '.$supplier->firstname }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>
        <div class="span6">
            <div class="control-group">
                <label for="initial-stpck" class="control-label">Initial Stock</label>
                <div class="controls">
                    <input type="text" value="{{ old('initial_stock') }}"name="initial_stock" autocomplete="off" class="span12" id="initial-stock">
                </div>
            </div>
        </div>

    </div>
    <div class="row-fluid warehouse init">
        <div class="span6">
            <div class="control-group">
                <label for="warehouse" class="control-label">Warehouse</label>
                <div class="controls">
                    <select name="warehouse_id[]" class="span12" id="select2_sample79" >
                        <option value="">--Select warehouse--</option>
                        @if(count($warehouses))
                            @foreach($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>
        <div class="span6">
            <div class="control-group">
                <label for="quantity" class="control-label">Quantity</label>
                <div class="controls">
                    <input type="number"name="warehouse_quantity[]" id="quantity" class="span12">
                </div>
            </div>
        </div>
    </div>

<div class="row-fluid more_warehouses" style="display: none;" >
    <div class="span6">
        <div class="control-group">
            <label for="addmore" class="control-label">Add More Warehouses</label>
            <div class="controls">
                <button class="btn btn-small btn-block btn-success" id="add-warehouse"><i class="icon-plus"></i> Add a Warehouse</button>
            </div>
        </div>
    </div>
</div>





<!-- END FORM -->
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
