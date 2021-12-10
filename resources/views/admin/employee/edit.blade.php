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
    {{-- {!! Form::model($data, ['method' => 'POST', 'autocomplete' => "off",'route' => ['admin.employee.update', $data->id]]) !!}
        @include('admin.employee._formEmployee')
    {!! Form::close() !!} --}}
    <div class="card py-2 px-3">
    <div class="tab-content pt-3" id="myTabContent">
        <div class="tab-pane fade show active" id="general" role="tabpanel">
            @livewire('admin.employee.tab-general', ['id' => $data->id, 'editable' => $editable])
        </div>
        @if (!empty($data))
            <div class="tab-pane fade" id="private" role="tabpanel">
                {{-- @livewire('staffmanagement::staff.tab-private', ['staffId' => $staff->id, 'editable' => $editable]) --}}
            </div>
            <div class="tab-pane fade" id="academic" role="tabpanel">
                {{-- @livewire('staffmanagement::staff.staff-diploma-list', ['staffId' => $staff->id, 'editable' => $editable]) --}}

                <hr>

                {{-- @livewire('staffmanagement::staff.staff-certificate-list', ['staffId' => $staff->id, 'editable' => $editable]) --}}
            </div>
            <div class="tab-pane fade" id="working-process" role="tabpanel">
                {{-- @livewire('staffmanagement::staff.tab-working', ['staffId' => $staff->id, 'editable' => $editable]) --}}
            </div>
            <div class="tab-pane fade" id="file" role="tabpanel">
                {{-- @livewire('staffmanagement::staff.tab-file', ['staffId' => $staff->id, 'editable' => $editable]) --}}
            </div>
        @endif
    </div>
    </div>
@endsection