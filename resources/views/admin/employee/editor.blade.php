@extends('layouts.master')
@section('title')
    <title>{{__('data_field_name.employee.list')}}</title>
@endsection
@section('content')
    <div class="body-content p-2">
        <div class="p-2 pb-3 d-flex align-items-center justify-content-between">
            <div class="">
                <h4 class="m-0">{{__('data_field_name.employee.edit')}}</h4>
            </div>
            <div class="paginate">
                <div class="d-flex">
                    <div class="">
                        <a href="{{ route('home') }}"><i class="fa fa-home"></i> {{__('data_field_name.common.home')}}</a>
                    </div>
                    <span class="px-2">/</span>
                    <div class="">
                        <div class="disable">{{__('data_field_name.employee.management')}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card py-2 px-3">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="tab-general" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">Thông tin nhân sự</a>
            </li>
    
            @if (!empty($data))
                <li class="nav-item">
                    <a class="nav-link" id="tab-private" data-toggle="tab" href="#private" role="tab" aria-controls="private" aria-selected="false">Thông tin cá nhân</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" id="tab-academic" data-toggle="tab" href="#academic" role="tab" aria-controls="academic" aria-selected="false">{{ __('staffmanagement::entities.diploma.id') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-working-process" data-toggle="tab" href="#working-process" role="tab" aria-controls="working-process" aria-selected="false">{{ __('staffmanagement::entities.working_process.id') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-file" data-toggle="tab" href="#file" role="tab" aria-controls="file" aria-selected="false">{{ __('staffmanagement::entities.staff_file.id') }}</a>
                </li> --}}
            @endif
    
        </ul>
        <div class="tab-content pt-3" id="myTabContent">
            <div class="tab-pane fade show active" id="general" role="tabpanel">
                @livewire('admin.employee.tab-general', ['id' => ($data->id) ?? 0])
            </div>
            @if (!empty($data))
                <div class="tab-pane fade" id="private" role="tabpanel">
                    @livewire('admin.employee.tab-private', ['id' => ($data->id) ?? 0])
                </div>
                {{-- <div class="tab-pane fade" id="academic" role="tabpanel">
                    @livewire('staffmanagement::staff.staff-diploma-list', ['staffId' => $staff->id, 'editable' => $editable])
    
                    <hr> --}}
    
                    {{-- @livewire('staffmanagement::staff.staff-certificate-list', ['staffId' => $staff->id, 'editable' => $editable])
                </div>
                <div class="tab-pane fade" id="working-process" role="tabpanel">
                    @livewire('staffmanagement::staff.tab-working', ['staffId' => $staff->id, 'editable' => $editable])
                </div>
                <div class="tab-pane fade" id="file" role="tabpanel">
                    @livewire('staffmanagement::staff.tab-file', ['staffId' => $staff->id, 'editable' => $editable])
                </div> --}}
            @endif
        </div>
    </div>
@endsection