<div wire:ignore.self class="modal fade" id="deleteSelectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <strong>
                <h5 class="modal-title" id="exampleModalLabel">{{__('notification.member.warning.warning')}}</h5>
              </strong>
            </div>
            <div class="modal-body">
              {{__('notification.member.warning.warning-1')}}
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">{{__('common.button.back')}}</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal" wire:click="selectall()">{{__('common.button.delete')}}</button>
            </div>
          </div>
        </div>
      </div>