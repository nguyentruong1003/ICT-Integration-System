@extends('layouts.master')
@section('title')
    <title>{{__('data_field_name.unit.list')}}</title>
@endsection
@section('content')
    <div class="body-content p-2">
        <div class="p-2 pb-3 d-flex align-items-center justify-content-between">
            <div class="">
                <h4 class="m-0">
                    {{__('data_field_name.unit.list')}}
                </h4>
            </div>
            <div class="paginate">
                <div class="d-flex">
                    <div class="">
                        <a href="{{ route('home') }}"><i class="fa fa-home"></i> {{__('data_field_name.common.home')}}</a>
                    </div>
                    <span class="px-2">/</span>
                    <div class="">
                        <div class="disable">{{__('data_field_name.unit.management')}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   @livewire('admin.unit.unit-list')
@endsection