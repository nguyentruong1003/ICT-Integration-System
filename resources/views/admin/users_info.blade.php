@extends('admin.index')

@section('list')
<div class="card card-body">
    <h5>{{ $pageName }}</h5>
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Birthday</th>
                <th>Address</th>
                <th>Description</th>
                <th>Unit</th>
                <th>Create At</th>
                <th>Create By</th>
                <th>Update At</th>
                <th>Update By</th>
                <th>Tools</th>
            </tr>
        </thead>
        <tbody>
            @foreach($user as $row)
            <tr>
                <td>{{$row->user_name}}</td>
                <td>{{$row->date_of_birth}}</td>
                <td>{{$row->address}}</td>
                <td>{{$row->description}}</td>
                <td>{{$row->unit}}</td>
                <td>{{$row->create_at}}</td>
                <td>{{$row->create_by}}</td>
                <td>{{$row->update_at}}</td>
                <td>{{$row->update_by}}</td>
                <td>Edit | Delete</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
