@extends('layouts.userLayout')

@section('content')
<div class="container">
    <!-- <a href="./users-create"><button class="btn btn-primary">CREATE</button></a></br></br> -->
    
    <ul style="display: flex; list-style-type: none">
        <li class="nav-item">
            <a href="#" class="btn btn-primary">SEARCH</a>
        </li>
    </ul>
    <div class="row">
        <table class="table text-center">
            <thead class="thead-dark">
                <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Birthday</th>
                <th scope="col">Unit</th>
                <th scope="col">Description</th>
                <th scope="col">Created At</th>
                <th scope="col">Updated At</th>
                <th scope="col">Created By</th>
                <th scope="col">Updated By</th>
                <th scope="col">Tools</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($users as $user)
                <tr style="backgroundColor:#fff">
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{($user->birth_date)? $user->birth_date : 'empty'}}</td>
                    <td>{{($user->unit)? $user->unit : 'empty'}}</td>
                    <td>{{($user->description)? $user->description : 'empty'}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->updated_at}}</td>  
                    <td>{{($user->created_by)? $user->created_by : 'empty'}}</td>
                    <td>{{($user->updated_by)? $user->updated_by : 'empty'}}</td> 
                    <td class="justify-content-center"> 
                        <a href={{"users-".$user->id}} class="btn btn-info btn-sm text-light">View</a>
                        <!-- <a href={{"users-update-".$user->id}} class="btn btn-success btn-sm text-light">Update</a>
                        <form action="{{url('users-'.$user->id)}}" method="POST" style="display:inline-block">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm text-light" value="Delete">
                        </form> -->
                    </td>
                </tr>
            @empty
                <div class="display-3 text-center">No Users Available</div>
            @endforelse
            </tbody>
        </table>
        
    </div>
        {{ $users->links() }}
    </div>
@endsection