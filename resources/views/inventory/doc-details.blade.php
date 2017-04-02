@php
    use App\Http\Controllers\InventoryController as InvCtrl;

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

    $cat = new InvCtrl();
    $cat_name = $cat->getCategoryName($doc->category_id)->category_name;
    $sub_cat_name = (!empty($doc->subcat_id)) ? $cat->getCategoryName($doc->subcat_id)->category_name : '';
@endphp
<ul class="unstyled span10">
    <li><span>Document Name: </span>{{ $doc->document_name }}</li>
    <li><span>Created By: </span>{{ $staff->surname.' '.$staff->firstname }}</li>
    <li><span>Uploaded On: </span>{{ date('d F Y', strtotime($doc->created_at)) }}</li>
    <li><span>Attached to: </span>{{ ($doc->attached_to == 'customer') ? $customer_name.' (Customer)' : $supplier_name.' (Supplier)' }}</li>
    <li><span>Category: </span>{{ $cat_name }}</li>
    <li><span>Sub Category: </span>{{ $sub_cat_name }}</li>
    <li><span>Visibility: </span>{!! ($doc->public) ? '<span class="label label-success">Public</span>' : '<span class="label label-default">Private</span>' !!}</li>
</ul>