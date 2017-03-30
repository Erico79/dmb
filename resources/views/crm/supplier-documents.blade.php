<table id="table1" class="table table-bordered">
    <thead>
    <th>Id</th>
    <th>Document Name</th>
    <th>Uploaded On</th>
    <th>Created By</th>
    </thead>
    <tbody>
    @if(count($docs))
        @foreach($docs as $version)
            @php
                $mf_id = \App\User::find($version->created_by)->masterfile_id;
                $staff = \App\Masterfile::find($mf_id);
            @endphp
            <tr>
                <td>{{ $version->id }}</td>
                <td>{{ $version->document_name }}</td>
                <td>{{ date('d F Y', strtotime($version->created_at)) }}</td>
                <td>{{ $staff->surname.' '.$staff->firstname }}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>