@extends('layouts.AdminLayout')

@section('content')
    <div class="container">
            <h3 class="text-center">Add New User</h3>
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <form method="POST" action="./users-store" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="full_name">Full Name <label style="color:red">*</label></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="full_name">
                        @error('name')
                            <div class="invalid-feedback">
                                    {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email address <label style="color:red">*</label></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email">
                        @error('email')
                            <div class="invalid-feedback">
                                    {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="pass">Password <label style="color:red">*</label></label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="pass">
                        @error('password')
                            <div class="invalid-feedback">
                                    {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="birth_date">Birthday <label style="color:red">*</label></label>
                        <input type="date" name="birth_date" class="form-control" id="birth_date" min="1000-01-01" max="9999-12-31">
                    </div>
                    <div class="form-group">
                        <label for="address">Address <label style="color:red">*</label></label>
                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="address">
                        @error('address')
                            <div class="invalid-feedback">
                                    {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" name="description" class="form-control" id="description">
                    </div>
                    <div class="form-group">
                        <label for="unit">Unit</label>
                        <select class="form-control" name="unit" id="unit">
                            <option disabled value="">-Choose-</option>
                            <option value="None">None</option>
                            @foreach ($unit_name as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                            
                        </select>
                        
                        
                    </div>
                    <div class="form-group">
                        <label for="created_by">Created By</label>
                        <input type="text" name="created_by" class="form-control @error('created_by') is-invalid @enderror" id="created_by" value='{{ $current_user->name }}' readonly>
                        
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Create</button>
                </form>
            </div>
        </div>
    </div>
    
@endsection