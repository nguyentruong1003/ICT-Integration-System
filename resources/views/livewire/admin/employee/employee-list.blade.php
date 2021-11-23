<div class="body-content p-2">
    <div class="card">
        <div class="card-body p-2">
            <div class="filter d-flex align-items-center justify-content-between mb-2">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group search-expertise">
                            <div class="search-expertise inline-block">
                                <input type="text" placeholder="Tìm kiếm theo tên" name="search"
                                    class="form-control" id='input_vn_name' autocomplete="off" wire:model.debounce.1000ms="searchName">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div>
                    <div class="input-group">
                        <a href="#" id="modal" class="btn btn-viewmore-news mr0 " data-toggle="modal" data-target="#ModalCreate" wire:click="resetInputFields">
                            <div class="btn-sm btn-primary">
                                <i class="fa fa-plus"></i> TẠO MỚI
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            
            <table class="table table-bordered table-hover dataTable dtr-inline">
                <thead class="">
                    <tr>
                        <th>STT</th>
                        <th>Mã nhân viên</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>SĐT</th>
                        <th>Ngày sinh</th>
                        <th>Đơn vị</th>
                        <th>Địa chỉ</th>
                        <th>Mô tả</th>
                        <th>Ghi chú</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                {{-- <div wire:loading class="loader"></div> --}}
                <tbody>
                    @forelse($data as $key => $row)
                        <tr>
                            <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                            <td>{{ $row->code }}</td>
                            <td>{!! boldTextSearch($row->fullname, $searchName) !!}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->phone }}</td>
                            <td>{{ $row->birthday }}</td>
                            <td>{{ $row->unit }}</td>
                            <td>{{ $row->address }}</td>
                            <td>{{ $row->description }}</td>
                            <td>{{ $row->note }}</td>
                            <td>{{ ReFormatDate($row->created_at,'d-m-Y') }}</td>
                            <td>
                                <a href="#" id="modal" class="btn btn-viewmore-news mr0 " data-toggle="modal" data-target="#ModalEdit"
                                    class="btn-sm border-0 bg-transparent" wire:click="edit({{ $row->id }})">
                                    <img src="/images/pent2.svg" alt="Edit">
                                </a>
                                @include('livewire.common.buttons._delete')
                            </td>
                        </tr>
                    @empty
                        <td colspan='12' class='text-center'>Không tìm thấy dữ liệu</td>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(count($data))
            {{ $data->links() }}
        @endif
    </div>
    @include('livewire.common._modalDelete')
    {{-- @include('livewire.admin.user._modalCreateEdit') --}}
</div>

{{-- <script>
    $("document").ready(function () {
        window.livewire.on('close-modal-create', () => {
            document.getElementById('close-modal-create').click()
        });
        window.livewire.on('close-modal-edit', () => {
            document.getElementById('close-modal-edit').click()
        });
    })
</script> --}}