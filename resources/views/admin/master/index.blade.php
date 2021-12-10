@extends('layouts.master')
@section('title')
    <title>Danh sách cấu hình</title>
@endsection
@section('content')
    <div class="body-content p-2">
        <div class="p-2 pb-3 d-flex align-items-center justify-content-between">
            <div class="">
                <h4 class="m-0">
                    Danh sách cấu hình
                </h4>
            </div>
            <div class="paginate">
                <div class="d-flex">
                    <div class="">
                        <a href="{{ route('home') }}"><i class="fa fa-home"></i> {{__('data_field_name.common.home')}}</a>
                    </div>
                    <span class="px-2">/</span>
                    <div class="">
                        <div class="disable">MasterData</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   @livewire('admin.config.master-data-list')
@endsection