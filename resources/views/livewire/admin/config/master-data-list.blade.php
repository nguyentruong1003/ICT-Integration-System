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
                    <div class="col-md-6">
                        <div class="form-group search-expertise">
                            <div class="search-expertise inline-block">
                                <input type="text" placeholder="{{__('data_field_name.common.search')}}" name="search"
                                    class="form-control" id='input_vn_name' autocomplete="off" wire:model.debounce.1000ms="searchTerm">
                            </div>
                        </div>
                    </div>
                    <div wire:ignore class="col-md-6">
                        <select wire:model.debounce.1000ms="searchType" class="form-control">
                            <option value="">
                                {{__('common.select.default')}}
                            </option>
                            @foreach (\App\Enums\EMasterData::getListData() as $id => $value)
                                <option value="{{ $id }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div>
                    {{-- @if($checkCreatePermission) --}}
                    @include('livewire.common.buttons._create')
                    {{-- @endif --}}
                </div>
            </div>
            
            <table class="table table-bordered table-hover dataTable dtr-inline">
                <thead class="">
                    <tr>
                        <th>{{__('data_field_name.common.order_number')}}</th>
                        <th>{{__('data_field_name.master-data.type')}}</th>
                        <th>{{__('data_field_name.master-data.key')}}</th>
                        <th>{{__('data_field_name.master-data.value')}}</th>
                        <th>{{__('data_field_name.master-data.order')}}</th>
                        {{-- @if($checkEditPermission || $checkDestroyPermission) --}}
                        <th>{{__('data_field_name.common.action')}}</th>
                        {{-- @endif --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $key => $row)
                        <tr>
                            <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                            <td>{{ \App\Enums\EMasterData::typeToName($row->type) }}</td>
                            <td>{!! boldTextSearch($row->key, $searchTerm) !!}</td>
                            <td>{!! boldTextSearch($row->value, $searchTerm) !!}</td>
                            <td>{{ $row->order }}</td>
                            {{-- @if($checkEditPermission || $checkDestroyPermission) --}}
                            <td>
                                {{-- @if($checkEditPermission) --}}
                                @include('livewire.common.buttons._edit')
                                {{-- @endif --}}
                                {{-- @if($checkDestroyPermission) --}}
                                    @include('livewire.common.buttons._delete')
                                {{-- @endif --}}
                            </td>
                            {{-- @endif --}}
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
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{$mode=='create'?__('data_field_name.common.create'):($mode=='update'?__('data_field_name.common.update'):__('data_field_name.common.show'))}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="resetInputFields()" id="closeModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('data_field_name.master-data.type')}} <span @if ($mode == 'show') hidden @endif style="color:red">*</span></label>
                                <select wire:model.lazy="type" class="form-control" @if($mode == 'show') disabled @endif>
                                    <option value="">
                                        {{__('common.select.default')}}
                                    </option>
                                    @foreach (\App\Enums\EMasterData::getListData() as $id => $value)
                                        <option value="{{ $id }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                @error("type")
                                    @include("layouts.partials.text._error")
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                             <div class="form-group">
                                <label>{{__('data_field_name.master-data.key')}} <span @if ($mode == 'show') hidden @endif style="color:red">*</span></label>
                                <input @if($mode == 'show') disabled @endif type="text" class="form-control" wire:model.lazy="key">
                                @error("key")
                                    @include("layouts.partials.text._error")
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('data_field_name.master-data.value')}} <span @if ($mode == 'show') hidden @endif style="color:red">*</span></label>
                                <input @if($mode == 'show') disabled @endif type="text" class="form-control" wire:model.lazy="value">
                                @error("value")
                                    @include("layouts.partials.text._error")
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                             <div class="form-group">
                                <label>{{__('data_field_name.master-data.order')}} <span @if ($mode == 'show') hidden @endif style="color:red">*</span></label>
                                <input @if($mode == 'show') disabled @endif type="text" class="form-control" wire:model.lazy="order">
                                @error("order")
                                    @include("layouts.partials.text._error")
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{{__('data_field_name.master-data.url')}}</label>
                        <input type="text" @if($mode == 'show') disabled @endif class="form-control" wire:model.lazy="url">
                    </div>
                    <div class="form-group">
                        <label>{{__('data_field_name.master-data.note')}}</label>
                        <input type="text" @if($mode == 'show') disabled @endif class="form-control" wire:model.lazy="note">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" wire:click='saveData'>{{__('common.button.save')}}</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" wire:click="resetInputFields()">{{__('common.button.cancel')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>
