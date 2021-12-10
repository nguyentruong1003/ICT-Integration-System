<div class="card py-2 px-3">
    <form>
        <div class="form-content">
            <div class="row">
                <div class="col">
                    <label>{{__('data_field_name.employee.fullname')}}<span class="text-danger" {{ ($check == 0) ? 'hidden' : '' }}> *</span></label>
                    <div class="input-group form-group">
                        {!! Form::text('fullname', null, array('placeholder' => '{{__("data_field_name.employee.fullname")}}', 'class' => 'form-control-sm form-control', 'disabled' => $check==0)) !!}
                        {{-- <input type="text" name="fullname"> --}}
                        @error('fullname')
                            @include('layouts.partials.text._error')
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <label>{{__('data_field_name.employee.code')}}<span class="text-danger" {{ ($check == 0) ? 'hidden' : '' }}> *</span></label>
                    <div class="input-group form-group">
                        {!! Form::text('code', null, array('placeholder' => "{{__('data_field_name.employee.code')}}", 'class' => 'form-control-sm form-control', 'disabled' => $check==0)) !!}
                        @error('code')
                            @include('layouts.partials.text._error')
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="form-content">
            <div class="row">
                <div class="col">
                    <label>{{__('data_field_name.employee.birthday')}}<span class="text-danger" {{ ($check == 0) ? 'hidden' : '' }}> *</span></label>
                    <div class="input-group form-group">
                        {!! Form::date('birthday', null, array('class' => 'form-control-sm form-control', 'disabled' => $check==0, 'max' => "{{ now()->toDateString('Y-m-d') }}")) !!}
                        @error('birthday')
                            @include('layouts.partials.text._error')
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <label>{{__('data_field_name.employee.sex')}}<span class="text-danger" {{ ($check == 0) ? 'hidden' : '' }}> *</span></label>
                    <div class="input-group form-group">
                        {!! Form::select('sex', ['' => "{{__('common.select.default')}}", '1' => "{{__('data_field_name.employee.male')}}", '2' => "{{__('data_field_name.employee.female')}}"], null,
                                        ['class' => 'form-control-sm form-control', 'disabled' => $check==0]) !!}
                        @error('sex')
                            @include('layouts.partials.text._error')
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="form-content">
            <div class="row">
                <div class="col">
                    <label>{{__('data_field_name.employee.phone')}}<span class="text-danger" {{ ($check == 0) ? 'hidden' : '' }}> *</span></label>
                    <div class="input-group form-group">
                        {!! Form::text('phone', null, array('placeholder' => "{{__('data_field_name.employee.phone')}}",'class' => 'form-control-sm form-control', 'disabled' => $check==0)) !!}
                        @error('phone')
                            @include('layouts.partials.text._error')
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <label>{{__('data_field_name.employee.email')}}<span class="text-danger" {{ ($check == 0) ? 'hidden' : '' }}> *</span></label>
                    <div class="input-group form-group">
                        {!! Form::text('email', null, array('placeholder' => "{{__('data_field_name.employee.email')}}", 'class' => 'form-control-sm form-control', 'disabled' => $check==0)) !!}
                        @error('email')
                            @include('layouts.partials.text._error')
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="form-content">
            <div class="row">
                <div class="col">
                    <label>{{__('data_field_name.employee.identity_code')}}<span class="text-danger" {{ ($check == 0) ? 'hidden' : '' }}> *</span></label>
                    <div class="input-group form-group">
                        {!! Form::text('identity_code', null, array('placeholder' => "{{__('data_field_name.employee.identity_code')}}",'class' => 'form-control-sm form-control', 'disabled' => $check==0)) !!}
                    </div>
                </div>
            </div>
        </div>

        @if ($check != 1) 
            @livewire('component.address', ['check' => $check, 'address' => $data->address, 'province_id' => $data->ex_province_id, 'district_id'=> $data->ex_district_id, 'ward_id'=>$data->ex_ward_id ])
        @else
            @livewire('component.address', ['check' => $check, 'address' => '', 'province_id' => '', 'district_id'=> '', 'ward_id'=> '' ])
        @endif

        <div class="form-content">
            <div class="row">
                <div class="col">
                    <label>{{__('data_field_name.employee.unit')}}</label>
                    <div class="input-group form-group">
                        <select name="unit" id="unit" class="form-control-sm form-control custom-input-control" {{ ($check==0)?'disabled':'' }}>
                            <option value="">{{__('common.select.default')}}</option>
                            @foreach ($unit_list as $unit)
                                <option value="{{ $unit->id }}" @if($check !=1) {{ ($unit->id == $data->unit_id) ? 'selected' : '' }} @endif>{{ $unit->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-content">
            <div class="row">
                <div class="col">
                    <label>{{__('data_field_name.employee.description')}}</label>
                    <div class="input-group form-group">
                        {!! Form::text('description', null, array('placeholder' => "{{__('data_field_name.employee.description')}}", 'class' => 'form-control-sm form-control', 'disabled' => $check==0)) !!}
                    </div> 
                </div>
            </div>
        </div>

        <div class="form-content">
            <div class="row">
                <div class="col">
                    <label>{{__('data_field_name.employee.note')}}</label>
                    <div class="input-group form-group">
                        {!! Form::text('note', null, array('placeholder' => "{{__('data_field_name.employee.note')}}", 'class' => 'form-control-sm form-control', 'disabled' => $check==0)) !!}
                    </div> 
                </div>
            </div>
        </div>
        
        <div class="form-content">
            <div class="row">
                @if ($check == 1)
                    <div class="col">
                        <label>{{__('data_field_name.common.creator')}}</label>
                        <div class="input-group form-group">
                            {!! Form::text('created_by', $current_user->name, array('disabled', 'class' => 'form-control-sm form-control')) !!}
                        </div>
                    </div>
                @elseif ($check == 2)
                    <div class="col">
                        <label>{{__('data_field_name.common.updater')}}</label>
                        <div class="input-group form-group">
                            {!! Form::text('created_by', $current_user->name, array('disabled', 'class' => 'form-control-sm form-control')) !!}
                        </div>
                    </div>
                @else 
                    <div class="col">
                        <label>{{__('data_field_name.common.creator')}}</label>
                        <div class="input-group form-group">
                            {!! Form::text('created_by', $data->creator->name, array('disabled', 'class' => 'form-control-sm form-control')) !!}
                        </div>
                    </div>
                    <div class="col">
                        <label>{{__('data_field_name.common.last_updater')}}</label>
                        <div class="input-group form-group">
                            {!! Form::text('created_by', ($data->updater->name) ?? "<{{__('common.message.no_value')}}>", array('disabled', 'class' => 'form-control-sm form-control')) !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
        
        <div class="w-100 clearfix my-2">
            @if ($check != 0)
            <button name="submit" type="submit" class="float-right btn ml-1 btn-primary">{{__('common.button.save')}}</button>
            @endif
            <a href="{{ route('admin.employee.index') }}" type="submit" class="btn btn-secondary float-right mr-1">{{__('common.button.back')}}</a>          
        </div>
    </form>
</div>