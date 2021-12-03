<div class="body-content p-2">
    <div class="card">
        <div class="card-body p-2">
            <div class="filter d-flex align-items-center justify-content-between mb-2">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group search-expertise">
                            <div class="search-expertise inline-block">
                                <input type="text" placeholder="{{__('data_field_name.common.search_by_name')}}" name="search"
                                    class="form-control" id='input_vn_name' autocomplete="off" wire:model.debounce.1000ms="searchName">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div>
                    @if($checkCreatePermission)
                    <div class="input-group">
                        <a href="{{route('admin.employee.create')}}" class="btn btn-viewmore-news mr0">
                            <div class="btn-sm btn-primary">
                                <i class="fa fa-plus"></i> {{__('common.button.create')}}
                            </div>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            
            <table class="table table-bordered table-hover dataTable dtr-inline">
                <thead class="">
                    <tr>
                        <th>{{__('data_field_name.common.order_number')}}</th>
                        <th>{{__('data_field_name.employee.code')}}</th>
                        <th>{{__('data_field_name.employee.fullname')}}</th>
                        <th>{{__('data_field_name.employee.birthday')}}</th>
                        <th>{{__('data_field_name.employee.sex')}}</th>
                        <th>{{__('data_field_name.employee.address')}}</th>
                        <th>{{__('data_field_name.employee.unit')}}</th>
                        <th>{{__('data_field_name.employee.note')}}</th>
                        @if($checkEditPermission || $checkDestroyPermission)
                        <th>{{__('data_field_name.common.action')}}</th>
                        @endif
                    </tr>
                </thead>
                {{-- <div wire:loading class="loader"></div> --}}
                <tbody>
                    @forelse($data as $key => $row)
                        <tr>
                            <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                            <td>{{ $row->code }}</td>
                            <td>
                                <a href="{{ route('admin.employee.show', ['id' => $row->id]) }}">
                                    {!! boldTextSearch($row->fullname, $searchName) !!}
                                </a>
                            </td>
                            <td>{{ ReFormatDate($row->birthday,'d/m/Y') }}</td>
                            <td>{{ ($row->sex == 1) ? 'Nam' : 'Nữ' }}</td>
                            <td>{{ ($row->ex_province_id) ? $row->province->short_name : '' }}</td>
                            <td>{{ ($row->unit->name) ?? 'root' }}</td>
                            <td>{{ $row->note }}</td>
                            @if($checkEditPermission || $checkDestroyPermission)
                            <td>
                                @if($checkEditPermission)
                                <a href="{{ route('admin.employee.edit', ['id' => $row->id]) }}"
                                    class="btn border-0 bg-transparent">
                                    <img src="/images/pent2.svg" alt="Edit">
                                </a>
                                @endif
                                @if($checkDestroyPermission)
                                    @include('livewire.common.buttons._delete')
                                @endif
                            </td>
                            @endif
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
</div>
