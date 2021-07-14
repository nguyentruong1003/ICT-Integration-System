@extends('layouts.userLayout')

@section('content')
<div class="container">
    <div style="float: right">
        <form method="head" action="./search">
            <input type="text" placeholder="Tìm kiếm..." name="search">
            <select name="ontype">
                <option value="name">Họ Tên</option>
                <option value="description">Mô Tả</option>
                <option value="address">Địa Chỉ</option>
            </select>
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <div></br>
        <label style="color: red; font-weight: bold">Từ khóa: {{ $key }}</br>Tìm kiếm theo: {{ $ontype }}</br>KẾT QUẢ: {{ sizeof($data) }}<label>
    </div>

    <div class="row">
        <table class="table text-center">
            <thead class="thead-light">
                <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Birthday</th>
                <th scope="col">Unit</th>
                <th scope="col">Address</th>
                <th scope="col">Description</th>
                <th scope="col">Created At</th>
                <th scope="col">Created By</th>
                <th scope="col">Updated At</th>
                <th scope="col">Updated By</th>
                <th scope="col">Controls</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($data as $user)
                <tr style="backgroundColor:#fff">
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{($user->birth_date)? $user->birth_date : 'empty'}}</td>
                    <td>{{($user->unit)? $user->unit : 'empty'}}</td>
                    <td>{{($user->address)? $user->address : 'empty'}}</td>
                    <td>{{($user->description)? $user->description : 'empty'}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>{{($user->created_by)? $user->created_by : 'empty'}}</td>
                    <td>{{$user->updated_at}}</td>  
                    <td>{{($user->updated_by)? $user->updated_by : 'empty'}}</td> 
                    <td class="justify-content-center"> 
                    </td>
                </tr>
            @empty
                <div class="display-4 text-center">No Users Available</div>
            @endforelse
            </tbody>
        </table>
        
    
@endsection