<form wire:submit.prevent="save">
    <div class="row">
        <div class="form-group col-lg-12">
            <label>Họ và tên</label>
            <input type="text" class="form-control" wire:model.lazy="emp_name" disabled>
            {{-- @error('emp_name') @include('layouts.partials.text._error') @enderror --}}
        </div>

        <div class="form-group col-lg-6">
            <label>Email cá nhân</label>
            <input type="text" class="form-control" wire:model.lazy="other_email" {{ $editable ? '' : 'disabled' }}>
            {{-- @error('other_email') @include('layouts.partials.text._error') @enderror --}}
        </div>

        <div class="form-group col-lg-6">
            <label>Tình trạng hôn nhân</label>
            <select class="form-control" wire:model.lazy="marital_status">
                <option value="">--Chọn--</option>
            </select>
            {{-- @error('marital_status') @include('layouts.partials.text._error') @enderror --}}
        </div>

        <div class="form-group col-lg-6">
            <label>Hộ khẩu thường trú</label>
            <input type="text" class="form-control" wire:model.lazy="address" {{ $editable ? '' : 'disabled' }}>
            {{-- @error('address') @include('layouts.partials.text._error') @enderror --}}
        </div>

        <div class="form-group col-lg-6">
            <label>Địa chỉ tạm trú</label>
            <input type="text" class="form-control" wire:model.lazy="temporary_address" {{ $editable ? '' : 'disabled' }}>
            {{-- @error('temporary_address') @include('layouts.partials.text._error') @enderror --}}
        </div>

        <div class="form-group col-lg-4">
            <label>Tôn giáo</label>
            <input type="text" class="form-control" wire:model.lazy="ethnic_id" {{ $editable ? '' : 'disabled' }}>
            {{-- @error('ethnic_id') @include('layouts.partials.text._error') @enderror --}}
        </div>

        <div class="form-group col-lg-4">
            <label>Dân tộc</label>
            <input type="text" class="form-control" wire:model.lazy="religion_id" {{ $editable ? '' : 'disabled' }}>
            {{-- @error('religion_id') @include('layouts.partials.text._error') @enderror --}}
            
        </div>

        <div class="form-group col-lg-4">
            <label>Quốc tịch</label>
            <input type="text" class="form-control" wire:model.lazy="nationality_id" {{ $editable ? '' : 'disabled' }}>
            {{-- @error('nationality_id') @include('layouts.partials.text._error') @enderror --}}
            
        </div>

        <div class="form-group col-lg-4">
            <label>CMND/CCCD </label>
            <input type="text" class="form-control" wire:model.lazy="identity_card" {{ $editable ? '' : 'disabled' }}>
            {{-- @error('identity_card') @include('layouts.partials.text._error') @enderror --}}
            
        </div>
        <div class="form-group col-lg-4">
            <label>Ngày cấp</label>
            <input type="text" class="form-control" wire:model.lazy="identity_card_date" {{ $editable ? '' : 'disabled' }}>
            {{-- @error('identity_card_date') @include('layouts.partials.text._error') @enderror --}}
            
        </div>

        <div class="form-group col-lg-4">
            <label>Nơi cấp</label>
            <input type="text" class="form-control" wire:model.lazy="identity_card_place" {{ $editable ? '' : 'disabled' }}>
            {{-- @error('identity_card_place') @include('layouts.partials.text._error') @enderror --}}
            
        </div>

        <div class="form-group col-lg-12">
            <label>Tiểu sử </label>
            <input type="text" class="form-control" wire:model.lazy="description" {{ $editable ? '' : 'disabled' }}>
            {{-- @error('description') @include('layouts.partials.text._error') @enderror --}}
            
        </div>
        <div class="form-group col-lg-12">
            <label>Ghi chú </label>
            <input type="text" class="form-control" wire:model.lazy="note" {{ $editable ? '' : 'disabled' }}>
            {{-- @error('note') @include('layouts.partials.text._error') @enderror --}}
            
        </div>
    </div>

    @if ($editable)
        <div class="w-100 clearfix my-2">
            <button class="float-right btn ml-1 btn-primary">{{__('common.button.save')}}</button>
            <a href="{{ route('admin.employee.index') }}" type="submit" class="btn btn-secondary float-right mr-1">{{__('common.button.back')}}</a>          
        </div>
    @endif
</form>
