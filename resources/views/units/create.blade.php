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
                        <input autofocus type="text" name="unit_name" class="form-control @error('unit_name') is-invalid @enderror" id="unit_name">
                        @error('unit_name')
                            <div class="invalid-feedback">
                                    {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="unit_id">Unit ID <label style="color:red">*</label></label>
                        <input type="text" name="unit_id" class="form-control" id="unit_id">
                        @error('unit_id')
                            <div class="invalid-feedback">
                                    {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="unit_father">Unit Father</label>
                        <select class="form-control" name="unit_father" id="unit">
                            <option disabled value="None">--Choose--</option>
                            @foreach ($unit_name as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" name="description" class="form-control" id="description">
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