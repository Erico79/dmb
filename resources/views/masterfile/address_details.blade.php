<!-- BEGIN FORM -->
    <div class="row-fluid">
        <div class="span6">
            <div class="control-group">
                <label for="county" class="control-label">County:<span>*</span></label>
                <div class="controls">
                    <select name="county" class="span12 live_search" id="county" >
                        <option value="">--Choose County--</option>
                        @if(count($counties))
                            @foreach($counties as $county)
                                <option value="{{ $county->county_code }}" {{ (old('county') == $county->county_code) ? 'selected': '' }}>{{ $county->county_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>
        <div class="span6">
            <div class="control-group">
                <label for="town" class="control-label">Town/city:<span>*</span></label>
                <div class="controls">
                    <input type="text" name="town" id="town" class="span12" maxlength="30" value="{{ old('town') }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="row-fluid">
        <div class="span6">
            <div class="control-group">
                <label for="ward" class="control-label">Ward</label>
                <div class="controls">
                    <input type="text" name="ward" class="span12" maxlength="30" value="{{ old('ward') }}" />
                </div>
            </div>
        </div>
        <div class="span6">
            <div class="control-group">
                <label for="street" class="control-label">Street:</label>
                <div class="controls">
                    <input type="text" name="street" class="span12" maxlength="30" value="{{ old('street') }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="row-fluid">
        <div class="span6">
            <div class="control-group">
                <label for="building" class="control-label">Building:</label>
                <div class="controls">
                    <input type="text" name="building" class="span12" maxlength="30" value="{{ old('building') }}" />
                </div>
            </div>
        </div>
        <div class="span6">
            <div class="control-group">
                <label for="phone" class="control-label">Phone Number:<span>*</span></label>
                <div class="controls">
                    <input type="number" name="phone" class="span12" maxlength="10" id="phone" value="{{ old('phone') }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="row-fluid">
        <div class="span6">
            <div class="control-group">
                <label for="postal_address" class="control-label">P.O Box:<span>*</span></label>
                <div class="controls">
                    <input type="text" name="postal_address" class="span12" maxlength="6" id="box" value="{{ old('postal_address') }}" />
                </div>
            </div>
        </div>
        <div class="span6">
            <div class="control-group">
                <label for="postal_code" class="control-label">Postal code:<span>*</span></label>
                <div class="controls">
                    <input type="text" name="postal_code" class="span12" maxlength="6" id="postal_code" value="{{ old('postal_code') }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="row-fluid">

        <div class="span6">
            <div class="control-group">
                <label for="address_type_name" class="control-label">Address Type:<span>*</span></label>
                <div class="controls">
                    <select name="address_type_name" id="address_type_name" class="span12">
                        <option value="">--Choose Address type--</option>
                        @if(count($addresses))
                            @foreach($addresses as $address)
                                <option value="{{ $address->address_type_code }}" {{ (old('address') == $address->address_type_code) ? 'selected': '' }}>{{ $address->address_type_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>
    </div>
<!-- END FORM -->