      <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body box-user">
              <h4 class="modal-title" id="exampleModalLabel">{{__('notification.member.warning.warning')}}</h4>
              {{__('notification.member.warning.warning-1')}}
              
            </div>
            <div class="group-btn2 text-center  pt-12">
              <button type="button" class="btn btn-cancel" data-dismiss="modal">{{__('common.button.back')}}</button>
              <button type="button" class="btn btn-save" data-dismiss="modal"  wire:click="delete({{$row->id}})">{{__('common.button.delete')}}</button>
            </div>
          </div>
        </div>
      </div>