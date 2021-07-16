@extends('layouts.AdminLayout')

@section('content')
    <div class="container">
            <h3 class="text-center">Update unit</h3>
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <form method="POST" action={{url('units-' . $unit->id)}} enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                        <label for="unit_name">Name <label style="color:red">*</label></label>
                        <input autofocus type="text" name="unit_name" class="form-control @error('unit_name') is-invalid @enderror" id="unit_name" value='{{$unit->unit_name}}'>
                        @error('unit_name')
                            <div class="invalid-feedback">
                                    {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="unit_id">Unit ID <label style="color:red">*</label></label>
                        <input type="text" name="unit_id" class="form-control" id="unit_id" value='{{$unit->unit_id}}'>
                        @error('unit_id')
                            <div class="invalid-feedback">
                                    {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="unit_father">Unit</label>
                        <select class="form-control" name="unit_father" id="unit_father" value='{{$unit->unit_father}}'>
                            <option disabled value="None">--Choose--</option>
                            @foreach ($unit_name as $value)
                                @if ($value == $unit->unit_father) {
                                    <option value="{{ $value }}" selected="selected">{{ $value }}</option> 
                                }
                                @else
                                <option value="{{ $value }}">{{ $value }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" name="description" class="form-control" id="description" value='{{$unit->description}}'>
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