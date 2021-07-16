@extends('layouts.adminLayout')

@section('content')
<div class="container">
    <div style="display: inline-flex">
        <a href="./users-create"><button class="btn btn-info btn-sm text-light">CREATE</button></a>
    </div>
    <div style="float: right">
        <ul style="list-style-type: none">
            <li><form style="float: right" method="head" action="./search">
                <input type="text" placeholder="Search..." name="search">
                
                <select name="ontype">
                    <option value="name">Name</option>
                    <option value="email">Email</option>
                    <option value="description">Description</option>
                    <option value="address">Address</option>
                    <option value="unit">Unit</option>
                </select>
                <button type="submit"><i class="fa fa-search"></i></button>
            </form></li>
            </br></br>
            <li><form style="float: right" method="head" action="./search">
                <label>Search by "Birthday"</label>
                <label>From</label>
                <input type="date" placeholder="Search..." name="from_date" min="1000-01-01" max="9999-12-31">
                <label>To</label>
                <input type="date" placeholder="Search..." name="to_date" min="1000-01-01" max="9999-12-31">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form></li>
        </ul>
    </div>
</br></br>
</br></br>


    <div class="row">
        @yield('content_2')
    </div>
</div>
@endsection