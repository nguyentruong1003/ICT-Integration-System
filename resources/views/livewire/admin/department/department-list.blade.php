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
                    @include('livewire.common.buttons._create')
                </div>
            </div>
            
            <table class="table table-bordered table-hover dataTable dtr-inline">
                <thead class="">
                    <tr>
                        <th>{{__('data_field_name.common.order_number')}}</th>
                        <th>{{__('data_field_name.department.code')}}</th>
                        <th>{{__('data_field_name.department.name')}}</th>
                        <th>{{__('data_field_name.department.leader')}}</th>
                        <th>{{__('data_field_name.department.description')}}</th>
                        <th>{{__('data_field_name.department.note')}}</th>
                        <th>{{__('data_field_name.department.status')}}</th>
                        @if($checkEditPermission || $checkDeletePermission)
                        <th>{{__('data_field_name.common.action')}}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $key => $row)
                        <tr>
                            <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                            <td>{!! boldTextSearch($row->code, $searchTerm) !!}</td>
                            <td>{!! boldTextSearch($row->name, $searchTerm) !!}</td>
                            <td>{!! boldTextSearch($row->leader->name ?? '', $searchTerm) !!}</td>
                            <td>{!! boldTextSearch($row->description, $searchTerm) !!}</td>
                            <td>{!! boldTextSearch($row->note, $searchTerm) !!}</td>
                            <td>{{ \App\Enums\ECommon::codeToValue(3, $row->status) }}</td>
                            @if($checkEditPermission || $checkDeletePermission)
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('data_field_name.department.name')}}<span @if ($mode == 'show') hidden @endif class="text-danger"> *</span></label>
                                <input @if($mode == 'show') disabled @endif type="text" class="form-control"  wire:model.lazy="name" placeholder="{{__('data_field_name.department.name')}}">
                                @error('name') @include("layouts.partials.text._error") @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('data_field_name.department.code')}}<span @if ($mode == 'show') hidden @endif class="text-danger"> *</span></label>
                                <input @if($mode == 'show') disabled @endif type="text" class="form-control"  wire:model.lazy="code" placeholder="{{__('data_field_name.department.code')}}">
                                @error('code') @include("layouts.partials.text._error") @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('data_field_name.department.leader')}}</label>
                                <select @if($mode == 'show') disabled @endif name="leader_id" class="form-control"  wire:model.lazy="leader_id" placeholder="{{__('data_field_name.department.department_leader')}}">
                                    <option value="">{{__('common.select.default')}}</option>
                                    @foreach ($leaders as $value)
                                        <option value="{{ $value->id }}" @if($value->id == $leader_id) selected @endif>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('data_field_name.department.status')}}</label>
                                <select @if($mode == 'show') disabled @endif class="form-control"  wire:model.lazy="status" placeholder="{{__('data_field_name.department.status')}}">
                                    @foreach (\App\Enums\ECommon::getListData()['3'] as $id => $value)
                                        <option value="{{ $id }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label >{{__('data_field_name.department.description')}}</label>
                        <input @if($mode == 'show') disabled @endif type="text" class="form-control"  wire:model.lazy="description" placeholder="{{__('data_field_name.department.description')}}">
                    </div>
                    <div class="form-group">
                        <label >{{__('data_field_name.department.note')}}</label>
                        <input @if($mode == 'show') disabled @endif type="text" class="form-control"  wire:model.lazy="note" placeholder="{{__('data_field_name.department.note')}}">
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
