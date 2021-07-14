@extends('layouts.AdminLayout')

@section('content')
<div class="container">
    <a class="btn btn-secondary" href="./units">Go Back</a>
    <h3 class="text-center">{{$unit->unit_name}}</h3>
    <div class="row">
        <div class="offset-md-2 col-md-8 mt-3 user-info">
            <p><strong>ID: </strong> {{$unit->unit_id}}</p> 
            <p><strong>Unit's Father: </strong> {{$unit->unit_father}}</p> 
            <p><strong>Description: </strong> {{$unit->description}}</p> 
            <p><strong>Created At: </strong> {{$unit->created_at}}</p> 
            <p><strong>Created By: </strong> {{$unit->created_by}}</p>
            <p><strong>Last Updated At: </strong> {{$unit->updated_at}}</p>  
            <p><strong>Last Updated By: </strong> {{$unit->updated_by}}</p>  

            <a href={{"units-update-".$unit->id}} class="btn btn-success btn-sm text-light">Update</a>
        </div>
    </div>
</div>
@endsection