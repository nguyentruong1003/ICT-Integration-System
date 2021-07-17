@extends('layouts.AdminLayout')

@section('content')
<div class="container">
        <a href="./units-create"><button class="btn btn-info btn-sm text-light">CREATE</button></a></br></br>
        <div class="row">
            
        <h4>Units List</h4>
        <div class="col-md-8">
           
           {{--Success Msg--}}
           @if (session('msg_success'))
               <div class="alert alert-success alert-dismissible fade show" role="alert">
                   <strong>{{session('msg_success')}}</strong>
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
           @endif            
        </div>
        
            <table class="table text-center">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">ID</th>
                        <th scope="col">Unit's Father</th>
                        <th scope="col">Description</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Updated By</th>
                        <th scope="col">Controls</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($units as $unit)
                    <tr style="backgroundColor:#fff">
                        <td>{{$unit->unit_name}}</td>
                        <td>{{$unit->unit_id}}</td>
                        <td>{{($unit->unit_father)? $unit->unit_father : 'empty'}}</td>
                        <td>{{($unit->description)? $unit->description : 'empty'}}</td>
                        <td>{{$unit->created_at}}</td> 
                        <td>{{($unit->created_by)? $unit->created_by : 'empty'}}</td>
                        <td>{{$unit->updated_at}}</td> 
                        <td>{{($unit->updated_by)? $unit->updated_by : 'empty'}}</td>  
                        <td class="justify-content-center"> 
                        <a href={{"units-".$unit->id}} class="btn btn-info btn-sm text-light">View</a>
                        <a href={{"units-update-".$unit->id}} class="btn btn-success btn-sm text-light">Update</a>
                        <form action="{{url('units-'.$unit->id)}}" method="POST" style="display:inline-block">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm text-light" value="Delete">
                        </form>
                    </td>
                    </tr>
                @empty
                    <div class="display-4 text-center">No units Available</div>
                @endforelse
                </tbody>
            </table>
</div>
        </div>
            {{ $units->links() }}
        </div>
@endsection