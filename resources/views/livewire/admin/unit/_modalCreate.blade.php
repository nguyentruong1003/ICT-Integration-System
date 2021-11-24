<form wire:submit.prevent="submit">
    <div wire:ignore.self class="modal fade" id="ModalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tạo mới đơn vị</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label >Tên đơn vị<span class="text-danger"> (*)</span></label>
                            <input type="text" class="form-control"  wire:model.lazy="name" placeholder="Tên đơn vị">
                            @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label >Mã đơn vị<span class="text-danger"> (*)</span></label>
                            <input type="text" class="form-control"  wire:model.lazy="code" placeholder="Mã đơn vị">
                            @error('code') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label >Mô tả</label>
                            <input type="text" class="form-control"  wire:model.lazy="description" placeholder="Mô tả">
                        </div>
                        <div class="form-group">
                            <label >Đơn vị cha</label>
                            <select name="father_id" class="form-control"  wire:model.lazy="father_id" placeholder="Đơn vị cha">
                                <option value="">--Chọn--</option>
                                @foreach ($unit_list as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label >Ghi chú</label>
                            <input type="text" class="form-control"  wire:model.lazy="note" placeholder="Ghi chú">
                        </div>
                        <div class="form-group">
                            <label >Người tạo</label>
                            <input type="text" class="form-control" disabled value="{{ $current_user->name }}" placeholder="Người tạo">
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