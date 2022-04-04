<div class="body-content p-2">
    <div class="card">
        <div class="card-body p-2">
            <div class="filter d-flex align-items-center justify-content-between mb-2">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group search-expertise">
                            <div class="search-expertise inline-block">
                                <input type="text" placeholder="{{__('data_field_name.common.search')}}" name="search"
                                    class="form-control" id='input_vn_name' autocomplete="off" wire:model.debounce.1000ms="searchTerm">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div>
                            <select wire:model.debounce.1000ms="userId" class="form-control">
                                <option value=''>
                                    --{{__('data_field_name.audit.performer')}}--
                                </option>
                                @foreach($userList as $item)
                                    <option value="{{$item['id']}}">
                                        {{$item['name']}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <input type="date" class="form-control" name="fromDate" wire:model.debounce.1000ms="from_date" autocomplete="off">
                    </div>

                    <div class="col-md-2">
                        <input type="date" class="form-control" name="toDate" wire:model.debounce.1000ms="to_date" autocomplete="off">
                    </div>

                    <div class="col-md-2">
                        @include('layouts.partials.button._reset')
                    </div>
                </div>
                {{-- <div>
                    <div class="input-group">
                        @include('layouts.partials.button._reset')
                    </div>
                </div> --}}
            </div>
            
            <table class="table table-bordered table-hover dataTable dtr-inline">
                <thead class="">
                    <tr>
                        <th>{{__('data_field_name.audit.performer')}}</th>
                        <th>{{__('data_field_name.audit.event')}}</th>
                        <th>{{__('data_field_name.audit.audittable_type')}}</th>
                        {{-- <th>ID bảng Audit</th> --}}
                        <th>{{__('data_field_name.audit.old_values')}}</th>
                        <th>{{__('data_field_name.audit.new_values')}}</th>
                        <th>{{__('data_field_name.audit.impact_date')}}</th>
                        {{-- <th>{{__('data_field_name.audit.url')}}</th> --}}
                        <th>{{__('data_field_name.audit.ip_address')}}</th>
                        {{-- <th>Tác nhân</th> --}}
                        <th>{{__('data_field_name.audit.note')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $key => $row)
                        <tr>
                            <td class="text-left">{!! boldTextSearch($row['perfomer'], $searchTerm) !!}</td>
                            <td class="text-left">{!! boldTextSearch($row['event'], $searchTerm) !!}<br>
                                <a href="" data-toggle="modal" data-target="{{'#show' . $row['id']}}">
                                    {{__('data_field_name.common.view_detail')}}
                                </a>
                                @include('livewire.admin.system.audit.detail')
                            </td>
                            <td class="text-left">{!! boldTextSearch($row['audittable_type'], $searchTerm) !!}</td>
                            {{-- <td class="text-left">{!! boldTextSearch($row['audittable_id'], $searchTerm) !!}</td> --}}
                            <td class="text-left">
                                @if(!empty($row['old_values']) && count($row['old_values']) > 0)
                                    @foreach($row['old_values'] as $index => $item)
                                        <p class="mb-1 content-audit-data"><span class="font-weight-bold">{{$index}}</span>: {!! boldTextSearch(json_encode($item, JSON_UNESCAPED_UNICODE), $searchTerm) !!}</p>
                                    @endforeach
                                @endif
                            </td>
                            <td class="text-left">
                                @if(!empty($row['new_values']) && count($row['new_values']) > 0)
                                    @foreach($row['new_values'] as $index => $item)
                                        <p class="mb-1 content-audit-data"><span class="font-weight-bold">{{$index}}</span>: {!! boldTextSearch(json_encode($item, JSON_UNESCAPED_UNICODE), $searchTerm) !!}</p>
                                    @endforeach
                                @endif
                            </td>
                            <td class="text-left">{!! reFormatDate($row['created_at'], 'd/m/Y') !!}</td>
                            {{-- <td class="text-left">
                                <p class="mb-1 content-audit-data">{!! boldTextSearch($row['url'], $searchTerm) !!}</p>
                            </td> --}}
                            <td class="text-left">{!! boldTextSearch($row['ip_address'], $searchTerm) !!}</td>
                            {{-- <td class="text-left">
                                <p class="mb-1 content-audit-data">{!! boldTextSearch($row['user_agent'], $searchTerm) !!}</p>
                            </td> --}}
                            <td class="text-left">{!! boldTextSearch($row['note'], $searchTerm) !!}</td>
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
</div>