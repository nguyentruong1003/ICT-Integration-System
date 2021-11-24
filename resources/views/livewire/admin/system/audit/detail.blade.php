<div wire:ignore class="modal fade" id="{{'show'. $row['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>THÔNG TIN CHI TIẾT</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <label>NGƯỜI TÁC ĐỘNG</label>
                        <div class="text-left"> 
                            {{$row['perfomer']}}
                        </div>
                    </div>
                    <div class="col">
                        <label>THAO TÁC</label>
                        <div class="text-left"> 
                            {{$row['event']}}
                        </div>
                    </div>
                    <div class="col">
                        <label>NGÀY TÁC ĐỘNG</label>
                        <div class="text-left"> 
                            {!! reFormatDate($row['created_at'], 'd/m/Y - H:s') !!}
                        </div>
                    </div>
                </div><hr>
                <div class="row">
                    <div class="col">
                        <label>LOẠI BẢNG AUDIT</label>
                        <div class="text-left"> 
                            {{$row['audittable_type']}}
                        </div>
                    </div>
                    <div class="col">
                        <label>ID BẢNG AUDIT</label>
                        <div class="text-left"> 
                            {{$row['audittable_id']}}
                        </div>
                    </div>
                </div><hr>
                <div class="row">
                    <div class="col-md-6">
                        <label>GIÁ TRỊ CŨ</label>
                        <div class="text-left">
                            @if(!empty($row['old_values']) && count($row['old_values']) > 0)
                                @foreach($row['old_values'] as $index => $item)
                                    <p class="mb-1 content-audit-data" title='{{$index.": ".json_encode($item)}}'><span class="font-weight-bold">{{$index}}</span>: {!! boldTextSearch(json_encode($item), $searchTerm) !!}</p>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>GIÁ TRỊ MỚI</label>
                        <div class="text-left">
                            @if(!empty($row['new_values']) && count($row['new_values']) > 0)
                                @foreach($row['new_values'] as $index => $item)
                                    <p class="mb-1 content-audit-data" title='{{$index.": ".json_encode($item)}}'><span class="font-weight-bold">{{$index}}</span>: {!! boldTextSearch(json_encode($item), $searchTerm) !!}</p>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div><hr>
                <div class="row">
                    <div class="col">
                        <label>URL</label>
                        <div class="text-left"> 
                            {{$row['url']}}
                        </div>
                    </div>
                </div><hr>
                <div class="row">
                    <div class="col">
                        <label>ĐỊA CHỈ IP</label>
                        <div class="text-left"> 
                            {{$row['ip_address']}}
                        </div>
                    </div>
                    <div class="col">
                        <label>TÁC NHÂN</label>
                        <div class="text-left"> 
                            {{$row['user_agent']}}
                        </div>
                    </div>
                </div><hr>
                <div class="row">
                    <div class="col">
                        <label>GHI CHÚ</label>
                        <div class="text-left"> 
                            {{$row['note']}}
                        </div>
                    </div>
                </div><hr>
            </div>
        </div>
    </div>
</div>

