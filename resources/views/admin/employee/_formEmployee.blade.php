<div class="card py-2 px-3">
    <form>
        <div class="form-content">
            <div class="row">
                <div class="col">
                    <label>Họ tên<span class="text-danger"> *</span></label>
                    <div class="input-group form-group">
                        {!! Form::text('fullname', null, array('placeholder' => 'Họ tên', 'class' => 'form-control-sm form-control')) !!}
                        @error('fullname')
                            @include('layouts.partials.text._error')
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <label>Mã nhân viên<span class="text-danger"> *</span></label>
                    <div class="input-group form-group">
                        {!! Form::text('code', null, array('placeholder' => 'Mã nhân viên', 'class' => 'form-control-sm form-control')) !!}
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
                    <label>Ngày sinh<span class="text-danger"> *</span></label>
                    <div class="input-group form-group">
                        <input value="birthday" name="birthday" type="date" @if($check == 0) disabled @endif class="form-control-sm form-control" max="{{ now()->toDateString('Y-m-d') }}" />
                        @error('birthday')
                            @include('layouts.partials.text._error')
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <label>Giới tính<span class="text-danger"> *</span></label>
                    <div class="input-group form-group">
                        {!! Form::select('sex', ['' => '--Chọn--', '1' => 'Nam', '2' => 'Nữ'], null,
                                        ['class' => 'form-control-sm form-control']) !!}
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
                    <label>Số điện thoại<span class="text-danger"> *</span></label>
                    <div class="input-group form-group">
                        {!! Form::text('phone', null, array('placeholder' => 'Số điện thoại','class' => 'form-control-sm form-control')) !!}
                        @error('phone')
                            @include('layouts.partials.text._error')
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <label>Email<span class="text-danger"> *</span></label>
                    <div class="input-group form-group">
                        {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control-sm form-control')) !!}
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
                    <label>CMND/CCCD<span class="text-danger"> *</span></label>
                    <div class="input-group form-group">
                        {!! Form::number('identity_code', null, array('placeholder' => 'CMND/CCCD','class' => 'form-control-sm form-control')) !!}
                    </div>
                </div>
            </div>
        </div>

        @livewire('component.address')

        <div class="form-content">
            <div class="row">
                <div class="col">
                    <label>Đơn vị công tác</label>
                    <div class="input-group form-group">
                        <select name="unit" id="unit" class="form-control-sm form-control custom-input-control">
                            <option value="" hidden>--Chọn--</option>
                            @foreach ($unit_list as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-content">
            <div class="row">
                <div class="col">
                    <label>Mô tả</label>
                    <div class="input-group form-group">
                        {!! Form::text('description', null, array('placeholder' => 'Tiểu sử','class' => 'form-control-sm form-control')) !!}
                    </div> 
                </div>
            </div>
        </div>

        <div class="form-content">
            <div class="row">
                <div class="col">
                    <label>Ghi chú</label>
                    <div class="input-group form-group">
                        {!! Form::text('note', null, array('placeholder' => 'Ghi chú','class' => 'form-control-sm form-control')) !!}
                    </div> 
                </div>
            </div>
        </div>

        <div class="form-content">
            <div class="row">
                <div class="col">
                    <label>Người tạo</label>
                    <div class="input-group form-group">
                        {!! Form::text('created_by', $current_user->name, array('disabled', 'class' => 'form-control-sm form-control')) !!}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="w-100 clearfix my-2">
            <button name="submit" type="submit" class="float-right btn ml-1 btn-primary">Lưu lại</button>
            <a href="{{ route('admin.employee.index') }}" type="submit" class="btn btn-secondary float-right mr-1">Hủy</a>          
        </div>
    </form>
</div>