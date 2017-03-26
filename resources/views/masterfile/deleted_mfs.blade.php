@extends('layouts.dt')
@section('title','Deleted Masterfile')
@section('page-title','Masterfile')
@section('page-title-small', 'Masterfile Record')
@section('breadcrumbs')
<li >
    <i class="icon-home"></i>
    <a href="{{ url('/home') }}">Home</a>
    <span class="icon-angle-right"></span>
</li>
<li>
    <span href="#">Masterfile</span>
    <span class="icon-angle-right"></span>
</li>
<li><span>Deleted Masterfile</span></li>
@endsection

@section('widget-title') All Deleted Masterfile - <span style="color: green;font-style: italic;" >list of all inactive masterfile</span> @endsection

@section('actions')
    {{--actions--}}
    <button id="refresh-btn" class="btn btn-info btn-small"><i class="icon-refresh"></i> Refresh</button>
@endsection

@section('content')
    @include('layouts.includes._messages')
    <div id="feedback"></div>
    <table id="table1" class="table table-bordered">
        <thead>
        <tr>
            <th>MfId#</th>
            <th>Full Name</th>
            <th>E-mail</th>
            <th>Buss Role</th>
            <th>Created Date</th>
            <th>Restore</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
            @if(count($del_mfs))
                @foreach($del_mfs as $mf)
                    <tr>
                        <td>{{ $mf->id }}</td>
                        <td>{{ $mf->surname.' '.$mf->firstname.' '.$mf->middlename }}</td>
                        <td>{{ $mf->email }}</td>
                        <td>{{ $mf->b_role }}</td>
                        <td>{{ $mf->reg_date }}</td>
                        <td><a href="{{ 'restore-mf/'.$mf->id }}" class="btn btn-mini btn-info restore_mf" id="{{ $mf->id }}" ><i class="icon-undo"></i> Restore</a> </td>
                        <td><a href="{{ 'destroy/'.$mf->id }}" class="btn btn-mini btn-danger delete_mf" id="{{ $mf->id }}" ><i class="icon-trash"></i> Delete</a> </td>

                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection

@push('js')
    <script src="{{ URL::asset('src_js/masterfile/del_mfs.js') }}"></script>
@endpush
