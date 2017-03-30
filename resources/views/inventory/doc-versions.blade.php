<table id="table1" class="table table-bordered">
    <thead>
        <th>Id</th>
        <th>Document Name</th>
        <th>Uploaded On</th>
        <th>Created By</th>
        <th>Attached To</th>
    </thead>
    <tbody>
        @php
            $other_versions = \App\Document::where('parent_doc', $doc->id)->get();
        @endphp
        @if(count($other_versions))
            @foreach($other_versions as $version)
                @php
                    $mf_id = \App\User::find($version->created_by)->masterfile_id;
                    $staff = \App\Masterfile::find($mf_id);
                    $mf = new \App\Http\Controllers\MasterfileController();

                    if(!empty($version->customer_mfid)){
                        $customer = $mf->getMfById($version->customer_mfid);
                        $customer_name = $customer->surname.' '.$customer->middlename;
                    }

                    if(!empty($version->supplier_mfid)){
                        $supplier = $mf->getMfById($version->supplier_mfid);
                        $supplier_name = $supplier->surname.' '.$supplier->middlename;
                    }
                @endphp
                <tr>
                    <td>{{ $version->id }}</td>
                    <td>{{ $version->document_name }}</td>
                    <td>{{ date('d F Y', strtotime($doc->created_at)) }}</td>
                    <td>{{ $staff->surname.' '.$staff->firstname }}</td>
                    <td>{{ ($version->attached_to == 'customer') ? $customer_name.' (Customer)' : $supplier_name.' (Supplier)' }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>