<form wire:submit.prevent="submit">
    <div wire:ignore.self class="modal fade" id="ModalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('data_field_name.user.create')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label >{{__('data_field_name.user.username')}}<span class="text-danger"> (*)</span></label>
                            <input type="text" class="form-control"  wire:model.lazy="name" placeholder="{{__('data_field_name.user.username')}}">
                            @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label >{{__('data_field_name.user.email')}}<span class="text-danger"> (*)</span></label>
                            <input type="text" class="form-control"  wire:model.lazy="email" placeholder="{{__('data_field_name.user.email')}}">
                            @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label >{{__('data_field_name.user.password')}}<span class="text-danger"> (*)</span></label>
                            <input type="password" class="form-control"  wire:model.lazy="password" placeholder="{{__('data_field_name.user.password')}}">
                            @error('password') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label >{{__('data_field_name.user.confirm_password')}}<span class="text-danger"> (*)</span></label>
                            <input type="password" class="form-control"  wire:model.lazy="confirm_password" placeholder="{{__('data_field_name.user.confirm_password')}}">
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
                    <h5 class="modal-title" id="exampleModalLabel">{{__('data_field_name.user.edit')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label >{{__('data_field_name.user.username')}}<span class="text-danger"> (*)</span></label>
                            <input type="text" class="form-control"  wire:model="name" placeholder="{{__('data_field_name.user.username')}}">
                            @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label >{{__('data_field_name.user.email')}}<span class="text-danger"> (*)</span></label>
                            <input type="text" class="form-control"  wire:model="email" placeholder="{{__('data_field_name.user.email')}}">
                            @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label >{{__('data_field_name.user.new_password')}}<span class="text-danger"> (*)</span></label>
                            <input type="password" class="form-control"  wire:model="password" placeholder="{{__('data_field_name.user.new_password')}}">
                            @error('password') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label >{{__('data_field_name.user.confirm_password')}}<span class="text-danger"> (*)</span></label>
                            <input type="password" class="form-control"  wire:model.lazy="confirm_password" placeholder="{{__('data_field_name.user.confirm_password')}}">
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