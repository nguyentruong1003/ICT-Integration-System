@extends('layouts.adminLayout')

@section('content')
<div class="container">
    <a class="btn btn-secondary" href="./users">Go Back</a>
    <h3 class="text-center">{{$user->name}}</h3>
    <div class="row">
        <div class="offset-md-2 col-md-8 mt-3 user-info">
            <p><strong>Email: </strong> {{$user->email}}</p> 
            <p><strong>Birthday: </strong> {{$user->birth_date}}</p> 
            <p><strong>Address: </strong> {{$user->address}}</p> 
            <p><strong>Unit: </strong> {{$user->unit}}</p> 
            <p><strong>Description: </strong> {{$user->description}}</p> 
            <p><strong>Created At: </strong> {{$user->created_at}}</p> 
            <p><strong>Created By: </strong> {{($user->created_by == $current_user->name)? 'You' : $user->created_by}}</p>
            <p><strong>Last Updated At: </strong> {{$user->updated_at}}</p>  
            <p><strong>Last Updated By: </strong> {{($user->updated_by == $current_user->name)? 'You' : (($user->updated_by)? $user->updated_by : 'empty')}}</p>  

            <a href={{"users-update-".$user->id}} class="btn btn-success btn-sm text-light">Update</a>
        </div>
    </div>
</div>
@endsection