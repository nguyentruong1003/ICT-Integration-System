 <!-- Modal Edit -->
 <form wire:submit.prevent="submit">
        <div wire:ignore.self class="modal fade" id="editModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('master/masterManager.form_data.edit')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true close-btn">×</span>
                </button>
              </div>
              <div class="modal-body">
              <form>
                     <input type="hidden" class="form-control" name="ID"  wire:model.lazy="ID" placeholder="id">
                    <div class="form-group">
                        <label >{{__('master/masterManager.menu_name.master_title_table.vkey')}}<span class="text-danger">(*)</span></label>
                        <input type="text" class="form-control" name="vkey"  wire:model.lazy="vkey" placeholder="{{__('master/masterManager.menu_name.master_title_table.vkey')}}">
                        @error('vkey') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label >{{__('master/masterManager.menu_name.master_title_table.vvalue')}}<span class="text-danger"></span></label>
                        <input type="text" class="form-control"  wire:model.lazy="vvalue" placeholder="{{__('master/masterManager.menu_name.master_title_table.vvalue')}}">
                        @error('vvalue') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label >{{__('master/masterManager.menu_name.master_title_table.vvalueen')}}<span class="text-danger"></span></label>
                        <input type="text" class="form-control"  wire:model.lazy="vvalueen" placeholder="{{__('master/masterManager.menu_name.master_title_table.vvalueen')}}">
                        @error('rank_id') <span class="text-danger ">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label >{{__('master/masterManager.menu_name.master_title_table.ordernumber')}}<span class="text-danger"></span></label>
                        <input type="number" class="form-control"  wire:model.lazy="ordernumber" placeholder="{{__('master/masterManager.menu_name.master_title_table.ordernumber')}}">
                        @error('ordernumber') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label >{{__('master/masterManager.menu_name.master_title_table.type')}}<span class="text-danger">(*)</span></label>
                        <input type="number" class="form-control"  wire:model.lazy="type" placeholder="{{__('master/masterManager.menu_name.master_title_table.type')}}">
                        @error('type') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label >{{__('master/masterManager.menu_name.master_title_table.parentid')}} <span class="text-danger"></span></label>
                        <input type="number" class="form-control"  wire:model.lazy="parentid" placeholder="{{__('master/masterManager.menu_name.master_title_table.parentid')}} ">
                        @error('rank_id') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </form>

              </div>
              <div class="modal-footer">
                <button type="button" id="close-modal-edit-department" class="btn btn-secondary close-btn" data-dismiss="modal" wire:click="resetform()">{{__('common.button.close')}}</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary close-modal">{{__('common.button.save')}}</button>
              </div>
            </div>
          </div>
        </div>
      </form>
      <!-- End Modal Edit -->
