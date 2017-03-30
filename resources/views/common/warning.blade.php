@if(Session::has('warning'))
    <div class="alert alert-warning">
        <button class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> {{ Session::get('warning') }}
    </div>
@endif