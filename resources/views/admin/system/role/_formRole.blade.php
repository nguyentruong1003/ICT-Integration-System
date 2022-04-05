<div class="card py-2 px-3">
    <form>
        {{-- <div class="form-content"> --}}
            <div class="col-md-12">
                <div class="form-group">
                    <label>{{__('data_field_name.role.name')}} <span class="text-danger">*</span></label>
                    {!! Form::text('name', null, array('class' => 'form-control form-control-sm')) !!}
                    @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            {{-- <div class="col-md-6">
                <div class="form-group">
                    <label>{{__('data_field_name.role.code')}} <span class="text-danger">*</span></label>
                    {!! Form::text('code', null, array('class' => 'form-control')) !!}
                    @error('code') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div> --}}
        {{-- </div> --}}

        <div class="col-md-12">
            <div class="form-group">
                <label>{{__('data_field_name.role.note')}}</label>
                {!! Form::text('note', null, array('class' => 'form-control form-control-sm')) !!}
                @error('note') <span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-1">
                    <label>{{__('data_field_name.role.status')}}</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <select name="status" class="form-control form-control-sm">
                        <option value="1">{{__('data_field_name.role.active')}}</option>
                        <option value="2">{{__('data_field_name.role.inactive')}}</option>
                    </select>
                </div>
            </div><br>

            <div class="table-responsive">
                <table class="table table-general working-plan">
                    <thead>
                        <tr class="border-radius">
                            <th rowspan="2" scope="col" class="border-radius-left">{{__('data_field_name.role.function')}}</th>
                            <th scope="col" class="text-center" rowspan="2">{{__('data_field_name.role.function_code')}}</th>
                            <th scope="col" class="text-center"><img src="/images/eye.svg" alt="eye"/></th>
                            <th scope="col" class="text-center"><img src="/images/add.svg" alt="add"></th>
                            <th scope="col" class="text-center"><img src="/images/pent2.svg" alt="pent"/> </th>
                            <th scope="col" class="text-center"><img src="/images/trash.svg" alt="trash"></th>
                            <th scope="col" class="text-center"><img src="/images/Export.svg" alt="download"/></th>
                            {{-- <th scope="col" class="text-center"><img src="/images/eye.svg" alt="eye"/></th>
                            <th scope="col" class="text-center"><img src="/images/eye.svg" alt="eye"/></th> --}}
                            <th scope="col" class="border-radius-right text-center"></th>
                        </tr>
                        <tr class="border-radius">
                            <th scope="col" class="text-center">{{__('data_field_name.role.permission.view')}}</th>
                            <th scope="col" class="text-center">{{__('data_field_name.role.permission.add')}}</th>
                            <th scope="col" class="text-center">{{__('data_field_name.role.permission.edit')}}</th>
                            <th scope="col" class="text-center">{{__('data_field_name.role.permission.delete')}}</th>
                            <th scope="col" class="text-center">{{__('data_field_name.role.permission.download')}}</th>
                            {{-- <th scope="col" class="text-center">{{__('data_field_name.role.permission.wait_approve')}}</th>
                            <th scope="col" class="text-center">{{__('data_field_name.role.permission.approve')}}</th> --}}
                            <th scope="col" class="border-radius-right text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($menus as $menu)
                        <tr>
                            <td>{!! $listNameMenu[$menu->name] ?? $menu->name !!}</td>
                            <td class="text-center">{!! $menu->code !!}</td>
                            @foreach($permissions as $permission)
                                @if (strpos($permission->name, str_replace('.index', '', $menu->permission_name)) !== false)
                                    @foreach($arrAction as $action)
                                        @if ($permission->name == str_replace('.index', '', $menu->permission_name). '.' . $action)
                                            <td class="text-center">
                                                <label class="box-checkbox checkbox-analysis">
                                                    @if (isset($rolePermissions))
                                                        @if (!empty($rolePermissions) && in_array($permission->id, $rolePermissions))
                                                            {{ Form::checkbox("role[$permission->id]", 1, true) }}
                                                        @else
                                                            {{ Form::checkbox("role[$permission->id]", 1, null) }}
                                                        @endif
                                                    @else
                                                        {{ Form::checkbox("role[$permission->id]", 1, null) }}
                                                    @endif
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                    {{-- @foreach () --}}
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="w-100 clearfix my-2">
            <button name="submit" type="submit" class="float-right btn ml-1 btn-primary">{{__('common.button.save')}}</button>
            <a href="{{ route('admin.system.role.index') }}" type="submit" class="btn btn-secondary float-right mr-1">{{__('common.button.back')}}</a>          
        </div>
    </form>
</div>