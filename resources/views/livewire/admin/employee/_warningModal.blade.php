<div wire:ignore.self class="modal fade" id="warningModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cảnh báo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="resetInputFields()" id="closeModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Phòng ban bạn chọn đã có vị trí trưởng phòng, bạn có muốn cập nhật dữ liệu không?
                <br>Trưởng phòng hiện tại sẽ được cập nhật vị trí thành phó phòng.
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" wire:click="saveData(true)">Có</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" wire:click="saveData(false)">Không</button>
            </div>
        </div>
    </div>
</div>