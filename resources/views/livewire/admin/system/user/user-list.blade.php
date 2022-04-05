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
                    @include('livewire.common.buttons._create')
                </div>
            </div>
            
            <table class="table table-bordered table-hover dataTable dtr-inline">
                <thead class="">
                    <tr>
                        <th>{{__('data_field_name.common.order_number')}}</th>
                        <th>{{__('data_field_name.user.name')}}</th>
                        <th>{{__('data_field_name.user.email')}}</th>
                        <th>{{__('data_field_name.user.role')}}</th>
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
                            <td>{{ $row->email }}</td>
                            <td>
                                @foreach($row->roles as $value)
                                    <span class="badge @if ($value->name == 'admin') badge-success @else badge-primary @endif">{{ $value->name }}</span>
                                @endforeach
                            </td>
                            <td>{{ ReFormatDate($row->created_at,'d-m-Y') }}</td>
                            @if ($checkEditPermission || $checkDeletePermission)
                            <td>
                                @include('livewire.common.buttons._edit')
                                @include('livewire.common.buttons._delete')
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
    <div wire:ignore.self class="modal fade" id="modalCreateEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{$mode=='create'?__('data_field_name.common.create'):($mode=='update'?__('data_field_name.common.update'):__('data_field_name.common.show'))}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="resetInputFields()" id="closeModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label >{{__('data_field_name.user.username')}}<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control"  wire:model="name" placeholder="{{__('data_field_name.user.username')}}">
                            @error('name') @include("layouts.partials.text._error") @enderror
                        </div>
                        <div class="form-group">
                            <label >{{__('data_field_name.user.email')}}<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control"  wire:model="email" placeholder="{{__('data_field_name.user.email')}}">
                            @error('email') @include("layouts.partials.text._error") @enderror
                        </div>
                        <div class="form-group">
                            <label >{{__('data_field_name.user.new_password')}}<span class="text-danger"> *</span></label>
                            <input type="password" class="form-control"  wire:model="password" placeholder="{{__('data_field_name.user.new_password')}}">
                            @error('password') @include("layouts.partials.text._error") @enderror
                        </div>
                        <div class="form-group">
                            <label >{{__('data_field_name.user.confirm_password')}}<span class="text-danger"> *</span></label>
                            <input type="password" class="form-control"  wire:model.lazy="confirm_password" placeholder="{{__('data_field_name.user.confirm_password')}}">
                            @error('confirm_password') @include("layouts.partials.text._error") @enderror
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" wire:click='saveData'>{{__('common.button.save')}}</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" wire:click="resetInputFields()">{{__('common.button.cancel')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>
