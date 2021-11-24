<form wire:submit.prevent="submit">
    <div wire:ignore.self class="modal fade" id="ModalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tạo mới người dùng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label >Tên người dùng<span class="text-danger"> (*)</span></label>
                            <input type="text" class="form-control"  wire:model.lazy="name" placeholder="Tên người dùng">
                            @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label >Email<span class="text-danger"> (*)</span></label>
                            <input type="text" class="form-control"  wire:model.lazy="email" placeholder="Email">
                            @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label >Mật khẩu<span class="text-danger"> (*)</span></label>
                            <input type="password" class="form-control"  wire:model.lazy="password" placeholder="Mật khẩu">
                            @error('password') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label >Xác nhận mật khẩu<span class="text-danger"> (*)</span></label>
                            <input type="password" class="form-control"  wire:model.lazy="confirm_password" placeholder="Xác nhận mật khẩu">
                            @error('confirm_password') <span class="text-danger">{{ $message }}</span>@enderror
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

{{-- <form wire:submit.prevent="submit"> --}}
    <div wire:ignore.self class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cập nhật người dùng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label >Tên người dùng<span class="text-danger"> (*)</span></label>
                            <input type="text" class="form-control"  wire:model="name" placeholder="Tên người dùng">
                            @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label >Email<span class="text-danger"> (*)</span></label>
                            <input type="text" class="form-control"  wire:model="email" placeholder="Email">
                            @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label >Mật khẩu mới<span class="text-danger"> (*)</span></label>
                            <input type="password" class="form-control"  wire:model="password" placeholder="Mật khẩu">
                            @error('password') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label >Xác nhận mật khẩu<span class="text-danger"> (*)</span></label>
                            <input type="password" class="form-control"  wire:model.lazy="confirm_password" placeholder="Xác nhận mật khẩu">
                            @error('confirm_password') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="close-modal-edit" wire:click.prevent="resetInputFields()" class="btn btn-secondary close-btn" data-dismiss="modal">{{__('common.button.cancel')}}</button>
                    <button type="button" class="btn btn-primary close-modal" wire:click.prevent="update">{{__('common.button.save')}}</button>
                </div>
            </div>
        </div>
    </div>
{{-- </form> --}}