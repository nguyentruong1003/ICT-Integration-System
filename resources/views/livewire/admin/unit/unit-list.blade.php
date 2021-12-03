<div class="body-content p-2">
    <div class="card">
        <div class="card-body p-2">
            <div class="filter d-flex align-items-center justify-content-between mb-2">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group search-expertise">
                            <div class="search-expertise inline-block">
                                <input type="text" placeholder="{{__('data_field_name.common.search')}}" name="search"
                                    class="form-control" id='input_vn_name' autocomplete="off" wire:model.debounce.1000ms="searchTerm">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div>
                    <div class="input-group">
                        <a href="#" id="modal" class="btn btn-viewmore-news mr0 " data-toggle="modal" data-target="#ModalCreate" wire:click="resetInputFields">
                            <div class="btn-sm btn-primary">
                                <i class="fa fa-plus"></i> {{__('common.button.create')}}
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            
            <table class="table table-bordered table-hover dataTable dtr-inline">
                <thead class="">
                    <tr>
                        <th>{{__('data_field_name.common.order_number')}}</th>
                        <th>{{__('data_field_name.unit.code')}}</th>
                        <th>{{__('data_field_name.unit.name')}}</th>
                        <th>{{__('data_field_name.unit.unit_father')}}</th>
                        <th>{{__('data_field_name.unit.description')}}</th>
                        <th>{{__('data_field_name.unit.note')}}</th>
                        <th>{{__('data_field_name.common.creator')}}</th>
                        <th>{{__('data_field_name.common.create_date')}}</th>
                        <th>{{__('data_field_name.common.action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $key => $row)
                        <tr>
                            <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                            <td>{!! boldTextSearch($row->code, $searchTerm) !!}</td>
                            <td>{!! boldTextSearch($row->name, $searchTerm) !!}</td>
                            <td>{{ ($row->father_unit->name) ?? '' }}</td>
                            <td>{!! boldTextSearch($row->description, $searchTerm) !!}</td>
                            <td>{!! boldTextSearch($row->note, $searchTerm) !!}</td>
                            <td>{{ ($row->creator->name) ?? '' }}</td>
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
                        <td colspan='12' class='text-center'>{{__('common.message.no_record')}}</td>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(count($data))
            {{ $data->links() }}
        @endif
    </div>
    @include('livewire.common._modalDelete')
    @include('livewire.admin.unit._modalCreate')
    @include('livewire.admin.unit._modalEdit')
</div>

<script>
    $("document").ready(function () {
        window.livewire.on('close-modal-create', () => {
            document.getElementById('close-modal-create').click()
        });
        window.livewire.on('close-modal-edit', () => {
            document.getElementById('close-modal-edit').click()
        });
    })
</script>
