<form wire:submit.prevent="submit">
    <div wire:ignore.self class="modal fade" id="ModalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('data_field_name.department.create')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label >{{__('data_field_name.department.name')}}<span class="text-danger"> (*)</span></label>
                            <input type="text" class="form-control"  wire:model.lazy="name" placeholder="{{__('data_field_name.department.name')}}">
                            @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label >{{__('data_field_name.department.code')}}<span class="text-danger"> (*)</span></label>
                            <input type="text" class="form-control"  wire:model.lazy="code" placeholder="{{__('data_field_name.department.code')}}">
                            @error('code') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label >{{__('data_field_name.department.description')}}</label>
                            <input type="text" class="form-control"  wire:model.lazy="description" placeholder="{{__('data_field_name.department.description')}}">
                        </div>
                        <div class="form-group">
                            <label >Trưởng phòng</label>
                            <select name="father_id" class="form-control"  wire:model.lazy="father_id" placeholder="{{__('data_field_name.department.department_father')}}">
                                <option value="">{{__('common.select.default')}}</option>
                                @foreach ($leaders as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label >{{__('data_field_name.department.note')}}</label>
                            <input type="text" class="form-control"  wire:model.lazy="note" placeholder="{{__('data_field_name.department.note')}}">
                        </div>
                        <div class="form-group">
                            <label >{{__('data_field_name.common.creator')}}</label>
                            <input type="text" class="form-control" disabled value="{{ $current_user->name }}" placeholder="{{__('data_field_name.common.creator')}}">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="close-modal-create" wire:click.prevent="resetInputFields()" class="btn btn-secondary close-btn" data-dismiss="modal">{{__('common.button.cancel')}}</button>
                    <button type="button" class="btn btn-primary close-modal" wire:click.prevent="store">{{__('common.button.save')}}</button>
                </div>
            </div>
        </div>
    </div>
</form>