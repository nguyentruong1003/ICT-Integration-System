@extends('layouts.AdminLayout')

@section('content')
    <div class="container">
            <h3 class="text-center">Add New Unit</h3>
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <form method="POST" action="./units-store" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="unit_name">Name <label style="color:red">*</label></label>
                        <input type="text" name="unit_name" class="form-control @error('unit_name') is-invalid @enderror" id="unit_name">
                        @error('unit_name')
                            <div class="invalid-feedback">
                                    {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <!-- <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email">
                        @error('email')
                            <div class="invalid-feedback">
                                    {{ $message }}
                            </div>
                        @enderror
                    </div> -->
                    <!-- <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="pass">
                        @error('password')
                            <div class="invalid-feedback">
                                    {{ $message }}
                            </div>
                        @enderror
                    </div> -->
                    <!-- <div class="form-group">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="male" name="gender" value="M" class="custom-control-input" />
                            <label class="custom-control-label" for="male">Male</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="female" name="gender" value="F" class="custom-control-input" />
                            <label class="custom-control-label" for="female">Female</label>
                        </div>
                    </div> -->
                    <!-- <div class="form-group">
                        <label for="birth_date">Birth Date</label>
                        <input type="date" name="birth_date" class="form-control" id="birth_date">
                    </div> -->
                    <div class="form-group">
                        <label for="unit_id">Unit ID <label style="color:red">*</label></label>
                        <input type="text" name="unit_id" class="form-control" id="unit_id">
                        @error('unit_id')
                            <div class="invalid-feedback">
                                    {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <!-- <div class="form-group">
                        <label for="unit">Unit</label>
                        <input type="text" name="unit" class="form-control @error('unit') is-invalid @enderror" id="unit">
                        @error('unit')
                            <div class="invalid-feedback">
                                    {{ $message }}
                            </div>
                        @enderror
                    </div> -->
                    <div class="form-group">
                        <label for="unit_father">Unit's Father</label>
                        <input type="text" name="unit_father" class="form-control" id="unit_father">
                        
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" name="description" class="form-control" id="description">
                    </div>
                    
                    <!-- <div class="form-group">
                        <label for="permissionSelect">Permission</label>
                        <select class="form-control" name="permission" id="permissionSelect">
                            <option value="read">Read</option>
                            <option value="write">Write</option>
                            <option value="execute">Execute</option>
                            <option value="delete">Delete</option>
                        </select>
                    </div> -->
                    <!-- <div class="form-group">
                        <div class="custom-file">    
                            <input type="file" class="custom-file-input" id="image" name="image">
                            <label class="custom-file-label" for="image">Upload Image</label>
                        </div>
                    </div> -->
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