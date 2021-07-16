@extends('layouts.AdminLayout')

@section('content')
    <div class="container">
            <h3 class="text-center">Update User</h3>
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <form method="POST" action={{url('users-' . $user->id)}} enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input autofocus type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="full_name" value='{{$user->name}}'>
                        @error('name')
                            <div class="invalid-feedback">
                                    {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value='{{$user->email}}'>
                        @error('email')
                            <div class="invalid-feedback">
                                    {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="birth_date">Birthday</label>
                        <input type="date" name="birth_date" class="form-control" id="birth_date" value='{{$user->birth_date}}'>
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="address" value='{{$user->address}}'>
                        @error('address')
                            <div class="invalid-feedback">
                                    {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="Description">Description</label>
                        <input type="text" name="Description" class="form-control" id="Description" value='{{$user->description}}'>
                    </div>

                    
                    <div class="form-group">
                        <label for="unit">Unit</label>
                        <select class="form-control" name="unit" id="unit" value='{{$user->unit}}'>
                            <option disabled value="None">--Choose--</option>
                            @foreach ($unit_name as $value)
                                @if ($value == $user->unit) {
                                    <option value="{{ $value }}" selected="selected">{{ $value }}</option> 
                                }
                                @else
                                <option value="{{ $value }}">{{ $value }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="updated_by">Updated By</label>
                        <input type="text" name="updated_by" class="form-control @error('updated_by') is-invalid @enderror" id="updated_by" value='{{ $current_user->name }}' readonly>
                        
                    </div>
                    
                    <input type="hidden" name="_method" value="PUT">
                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                </form>
            </div>
        </div>
    </div>
    
@endsection