<div class="form-content">
    <div class="row">
        <div class="col">
            <label>Địa chỉ</label>
            <div class="row">
                <div class="col-1"></div>
                <div class="col">
                    <div class="form-group row">
                        <label class="col-md-2">Thành phố/Tỉnh:</label>
                        <div class="col">
                            <select wire:model.lazy="province_id" name='province' id="supplyProvince" class="form-control-sm form-control" {{($check==0)?'disabled':''}}>
                                <option value="" hidden>--Chọn Thành phố/Tỉnh--</option>
                                @foreach($province as $key=> $item)
                                    <option value="{{$key}}" {{$key==$province_id?'selected':''}}>{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2">Quận/Huyện:</label>
                        <div class="col">
                            <select wire:model.lazy="district_id" name='district' id="supplyDistrict" class="form-control-sm form-control" {{($check==0)?'disabled':''}}>
                                <option value="" hidden>--Chọn Quận/Huyện--</option>
                                @foreach($district as $key=> $item)
                                    <option value="{{$key}}" {{$key==$district_id?'selected':''}}>{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2">Phường/Xã:</label>
                        <div class="col">
                            <select wire:model.lazy="ward_id" id="supplyWard" name='ward' class="form-control-sm form-control" {{($check==0)?'disabled':''}}>
                                <option value="" hidden>--Chọn Phường/Xã--</option>
                                @foreach($ward as $key=> $item)
                                    <option value="{{$key}}" {{$key==$ward_id?'selected':''}}>{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-2">Địa chỉ cụ thể:</label>
                        <div class="col">
                            <input id="Address" wire:model="address" name='address' placeholder="Địa chỉ cụ thể" type="text" class="form-control form-control-sm " {{($check==0)?'disabled':''}}>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('js')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            $('#supplyProvince').on('change', function (e) {
                var data = $('#supplyProvince').select2("val");
                @this.set('province_id', data);
            });
            $('#supplyDistrict').on('change', function (e) {
                var data = $('#supplyDistrict').select2("val");
                @this.set('district_id', data);
            });
            $('#supplyWard').on('change', function (e) {
                var data = $('#supplyWard').select2("val");
                @this.set('ward_id', data);
            });
        })
    </script>
@endsection