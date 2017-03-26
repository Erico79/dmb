
<div class="row-fluid">
    <div class="span6">
        <div class="control-group">
            <label for="sub-category" class="control-label">category</label>
            <div class="controls">
                <select data-placeholder="Select item sub category" name="sub_category_id" class="live_search span12" id="item_sub_category">
                    <option value="">--please select a category--</option>
                    @if(count($categories))
                        @foreach($categories as $category)
                            <optgroup label="{{ $category->category_name }}">
                                <?php
                                $scs = \App\SubCategory::where('category_id', $category->id)->get();
                                ?>
                                @if(count($scs))
                                    @foreach($scs as $sc)
                                        <option value="{{ $sc->id }}">{{ $sc->sub_category_name }}</option>
                                    @endforeach
                                @endif
                            </optgroup>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>

    <div class="span6">
        <div class="control-group">
            <label for="purchase-price" class="control-label">Buying price</label>
            <div class="controls">
                <input type="number" value="{{ old('purchase_price') }}"name="purchase_price" autocomplete="off" class="span12" id="purchase-price" />
            </div>
        </div>
    </div>
</div>

<div class="row-fluid">

    <div class="span6">
        <div class="control-group">
            <label for="item-name" class="control-label" id="variation">Name/title</label>
            <div class="controls  input-icon">
                <input type="text" value="{{ old('item_name') }}"name="item_name" autocomplete="off" class="span12" id="item-name">
            </div>
        </div>
    </div>
    <div class="span6">
        <div class="control-group">
            <label class="control-label" for="item-code" id="id_pass">Item Code</label>
            <div class="controls">
                <input type="text" value="{{ old('item_code') }}" autocomplete="off" name="item_code" class="span12" id="item-code">
            </div>
        </div>
    </div>

</div>

<div class="row-fluid">
    <div class="span6">
        <div class="control-group">
            <label for="reorder-level" class="control-label">Reorder level</label>
            <div class="controls">
                <input type="number" value="{{ old('stock_reorder_level') }}"name="stock_reorder_level" autocomplete="off" class="span12" id="reorder-level" />
            </div>
        </div>
    </div>
    <div class="span6">
        <label class="control-label">Main picture</label>
        <div class="controls">
            <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-new thumbnail" style="width: 100px; height: 100px;"><img src="assets/img/items.png" style="width: 100%; height: 100%" /></div>
                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 100px; max-height: 100px; line-height: 20px;"></div>
                <div>
                    <label class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input class="span12 block" type="file" style="display: none" name="main_image_path"/></label>
                    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                </div>
            </div>
        </div>
    </div>
</div>