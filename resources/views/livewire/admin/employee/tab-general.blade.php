<form wire:submit.prevent="save">
    <div class="row">
        <div class="form-group col-lg-6">
            <label>Họ và tên <span class="text-danger">*</span></label>
            <input type="text" class="form-control" wire:model.lazy="name" {{ $editable ? '' : 'disabled' }}>
            @error('name') @include('layouts.partials.text._error') @enderror
        </div>

        <div class="form-group col-lg-6">
            <label>Mã nhân viên <span class="text-danger">*</span></label>
            <input type="text" class="form-control" wire:model.lazy="code" {{ $editable ? '' : 'disabled' }}>
            @error('code') @include('layouts.partials.text._error') @enderror
        </div>

        <div class="form-group col-lg-6">
            <label>Ngày sinh <span class="text-danger">*</span></label>
            <input type="date" class="form-control" wire:model.lazy="birthday" {{ $editable ? '' : 'disabled' }}>
            @error('birthday') @include('layouts.partials.text._error') @enderror
        </div>

        <div class="form-group col-lg-6">
            <label>Giới tính <span class="text-danger">*</span></label>
            <select class="form-control" wire:model.lazy="sex">
                <option value="">--Chọn--</option>
                <option value="1">Nam</option>
                <option value="2">Nữ</option>
            </select>
        </div>

        <div class="form-group col-lg-6">
            <label>Số điện thoại <span class="text-danger">*</span></label>
            <input type="text" class="form-control" wire:model.lazy="phone" {{ $editable ? '' : 'disabled' }}>
            @error('phone') @include('layouts.partials.text._error') @enderror
        </div>

        <div class="form-group col-lg-6">
            <label>Email <span class="text-danger">*</span></label>
            <input type="text" class="form-control" wire:model.lazy="email" {{ $editable ? '' : 'disabled' }}>
            @error('email') @include('layouts.partials.text._error') @enderror
        </div>

        <div class="form-group col-lg-6">
            <label>Đơn vị <span class="text-danger">*</span></label>
            
        </div>

        <div class="form-group col-lg-6">
            <label>Chức vụ <span class="text-danger">*</span></label>
            
        </div>

        <div class="form-group col-lg-6">
            <label>Người quản lý </label>
            
        </div>
        <div class="form-group col-lg-6">
            <label>Địa chỉ làm việc </label>
            
        </div>
    </div>

    @if ($editable)
        <div class="w-100 clearfix my-2">
            <button class="float-right btn ml-1 btn-primary">{{__('common.button.save')}}</button>
            <a href="{{ route('admin.employee.index') }}" type="submit" class="btn btn-secondary float-right mr-1">{{__('common.button.back')}}</a>          
        </div>
    @endif
</form>
