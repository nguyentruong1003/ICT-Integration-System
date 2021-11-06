<div wire:init="openModal" wire:ignore.self class="modal fade" id="createModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sửa mới master data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label >Id<span class="text-danger">(*)</span></label>
                        <input type="text" class="form-control"  wire:model.lazy="name" placeholder="ID">
                        @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label >V key<span class="text-danger">(*)</span></label>
                        <input type="text" class="form-control"  wire:model.lazy="school" placeholder="V key">
                        @error('school') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label >V value<span class="text-danger">(*)</span></label>
                        <input type="date" class="form-control"  wire:model.lazy="graduated_year" placeholder="V value">
                        @error('graduated_year') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label >Oder number<span class="text-danger">(*)</span></label>
                        <input type="number" class="form-control"  wire:model.lazy="score" placeholder="Order number">
                        @error('score') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label >Type<span class="text-danger">(*)</span></label>
                        <input type="number" class="form-control"  wire:model.lazy="score" placeholder="Type">
                        @error('rank_id') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label >V value en<span class="text-danger">(*)</span></label>
                        <input type="text" class="form-control"  wire:model.lazy="score" placeholder="V value en">
                        @error('rank_id') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label >Parent id<span class="text-danger">(*)</span></label>
                        <input type="number" class="form-control"  wire:model.lazy="score" placeholder="Parent id">
                        @error('rank_id') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="close-academic-create2" wire:click.prevent="resetInputFields()" class="btn btn-secondary close-btn" data-dismiss="modal">{{__('common.button.delete')}}</button>
                <button type="button" class="btn btn-primary close-modal" wire:click.prevent="storeType2()">{{__('common.button.save')}}</button>
            </div>
        </div>
    </div>
</div>

    <div wire:init="openModal" wire:ignore.self class="modal fade" id="updateModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('data_field_name.user.edit_certificate')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label >{{__('data_field_name.user.name_certificate')}}<span class="text-danger">(*)</span></label>
                            <input type="text" class="form-control"  wire:model.lazy="name" placeholder="{{__('data_field_name.user.input_certificate')}}">
                            @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label >{{__('data_field_name.user.area')}}<span class="text-danger">(*)</span></label>
                            <input type="text" class="form-control"  wire:model.lazy="school" placeholder="{{__('data_field_name.user.input_area')}}">
                            @error('school') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label >{{__('data_field_name.user.create_at')}} <span class="text-danger">(*)</span></label>
                            <input type="date" class="form-control"  wire:model.lazy="graduated_year" placeholder="{{__('data_field_name.user.input_created_at')}}">
                            @error('graduated_year') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label >{{__('data_field_name.user.point')}}<span class="text-danger">(*)</span></label>
                            <input type="number" class="form-control"  wire:model.lazy="score" placeholder="{{__('data_field_name.user.input_point')}}">
                            @error('score') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label >{{__('data_field_name.user.classification')}}<span class="text-danger">(*)</span></label>
                            <select class="form-control" wire:model.lazy="rank_id">
                                <option value="">--{{__('data_field_name.user.classification')}}--</option>
                             
                            </select>
                            @error('rank_id') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="close-academic-update2" wire:click.prevent="resetInputFields()" class="btn btn-secondary close-btn" data-dismiss="modal">{{__('common.button.delete')}}</button>
                    <button type="button" class="btn btn-primary close-modal" wire:click.prevent="storeType2()">{{__('common.button.save')}}</button>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="exampleDelete2" tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body box-user">
                    <h4 class="modal-title">{{__('data_field_name.common_field.confirm_delete')}}</h4>
                    {{__('notification.member.warning.warning-1')}}
                </div>
                <div class="group-btn2 text-center pt-24">
                    <button type="button" class="btn btn-cancel" data-dismiss="modal">{{__('common.button.back')}}</button>
                    <button type="button" wire:click.prevent="delete2()" class="btn btn-save" data-dismiss="modal">{{__('common.button.delete')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>