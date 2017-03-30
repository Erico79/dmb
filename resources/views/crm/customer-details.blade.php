<ul class="unstyled span10">
    <li><span>Customer Name: </span>{{ $customer->surname.' '.$customer->firstname }}</li>
    <li><span>ID Number: </span>{{ $customer->id_passport }}</li>
    <li><span>Gender: </span>{{ ($customer->gender == 't') ? 'Male' : 'Female'  }}</li>
    <li><span>Registration Date: </span>{{ date('d F Y', strtotime($customer->reg_date)) }}</li>
    <li><span>Email Address: </span>{{ $customer->email }}</li>
    <li><span>Masterfile Type: </span>{{ $customer->customer_type_name }}</li>
    <li><span>Status: </span>{{ ($customer->status) ? 'Active' : 'Inactive' }}</li>
</ul>