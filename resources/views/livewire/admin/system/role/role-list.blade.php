<div class="body-content p-2">
    <div class="card">
        <div class="card-body p-2">
            <div class="session-area">
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        {!! \Session::get('success') !!}
                    </div>
                @endif
                @if (\Session::has('error'))
                    <div class="alert alert-warning">
                        {!! \Session::get('error') !!}
                    </div>
                @endif
            </div>
            
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
                    @if ($checkCreatePermission)
                    <div class="input-group">
                        <a href="{{ route('admin.system.role.create') }}" class="btn btn-viewmore-news mr0">
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
                        <th>{{__('data_field_name.role.name')}}</th>
                        <th>{{__('data_field_name.common.create_date')}}</th>
                        @if ($checkEditPermission || $checkDeletePermission)
                        <th>{{__('data_field_name.common.action')}}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $key => $row)
                        <tr>
                            <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                            <td>{!! boldTextSearch($row->name, $searchName) !!}</td>
                            <td>{{ ReFormatDate($row->created_at,'d-m-Y') }}</td>
                            @if ($checkEditPermission || $checkDeletePermission)
                            <td>
                                @if ($row->name != 'admin')
                                @if ($checkEditPermission)
                                <a href="{{ route('admin.system.role.edit', ['id' => $row->id]) }}" class="btn border-0 bg-transparent">
                                    <img src="/images/pent2.svg" alt="Edit">
                                </a>
                                @endif
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

