@php
    $mf_id = \App\User::find($doc->created_by)->masterfile_id;
    $staff = \App\Masterfile::find($mf_id);
    $mf = new \App\Http\Controllers\MasterfileController();

    if(!empty($doc->customer_mfid)){
        $customer = $mf->getMfById($doc->customer_mfid);
        $customer_name = $customer->surname.' '.$customer->middlename;
    }

    if(!empty($doc->supplier_mfid)){
        $supplier = $mf->getMfById($doc->supplier_mfid);
        $supplier_name = $supplier->surname.' '.$supplier->middlename;
    }
@endphp
<ul class="unstyled span10">
    <li><span>Document Name: </span>{{ $doc->document_name }}</li>
    <li><span>Created By: </span>{{ $staff->surname.' '.$staff->firstname }}</li>
    <li><span>Uploaded On: </span>{{ date('d F Y', strtotime($doc->created_at)) }}</li>
    <li><span>Attached to: </span>{{ ($doc->attached_to == 'customer') ? $customer_name.' (Customer)' : $supplier_name.' (Supplier)' }}</li>
</ul>