
<div class="span2"><img src="{{ URL::asset(empty($mf->image_path) ? 'assets/img/photo.jpg' : $mf->image_path) }}" alt="" /></div>

<ul class="unstyled span10">
    <li><span>Full Name: </span>{{ $mf->surname.' '.$mf->firstname.' '.$mf->middlename }}</li>
    <li><span>Masterfile Type: </span>{{ $mf->customer_type_name }}</li>
    <li><span>Gender: </span>{{ ($mf->gender == 1) ? 'Male' : 'Female' }}</li>
    <li><span>Start Date: </span>{{ $mf->reg_date }}</li>
    <li><span>Business Role: </span>{{ $mf->b_role }}</li>
    <li><span>Email address: </span>{{ $mf->email }}</li>
    <li><span>ID No/Passport: </span>{{ $mf->id_passport }}</li>
</ul>