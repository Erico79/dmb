<ul class="unstyled span10">
    <li><span>Supplier Name: </span>{{ $supplier->surname.' '.$supplier->middlename }}</li>
    <li><span>ID Number: </span>{{ $supplier->id_passport }}</li>
    <li><span>Gender: </span>{{ ($supplier->gender == 't') ? 'Male' : 'Female'}}</li>
    <li><span>Registration Date: </span>{{ date('d F Y', strtotime($supplier->reg_date)) }}</li>
    <li><span>Email Address: </span>{{ $supplier->email }}</li>
    <li><span>Masterfile Type: </span>{{ $supplier->customer_type_name }}</li>
    <li><span>Status: </span>{{ ($supplier->status) ? 'Active' : 'Inactive' }}</li>
</ul>