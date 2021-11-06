
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                 <h3 class="card-title my-3">{{__('master/masterManager.menu_name.master_title')}}</h3>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group search-expertise">
                            <div class="search-expertise inline-block">
                                <input type="text" placeholder="{{__('common.button.search')}}" name="search" class="form-control" wire:model.lazy="search"  id='input_vn_name' autocomplete="off">
                            </div>
                            
                        </div>
                    </div>
                    <div wire:ignore class="col-md-2">
                        <select wire:model.lazy="typeFilter" class="form-control">
                            <option value=''>
                                {{__('master/masterManager.menu_name.type')}}
                            </option>
                            @foreach($dataType as $item)
                                <option value='{{$item->type}}'>
                                    {{$item->v_key}}
                                </option>1
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-7">
                        <button type="button" class="float-right" style="border-radius: 11px; border:none;" data-toggle="modal" data-target="#createModal" wire:click="resetform()" >
                                   <img src="/images/plus3.svg" alt="pent">
                            </button>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">{{__('master/masterManager.menu_name.master_title_table.ID')}}</th>
                                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">{{__('master/masterManager.menu_name.master_title_table.vkey')}}</th>

                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">{{__('master/masterManager.menu_name.master_title_table.type')}}</th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">{{__('master/masterManager.menu_name.master_title_table.vvalue')}}</th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">{{__('master/masterManager.menu_name.master_title_table.vvalueen')}}</th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">{{__('master/masterManager.menu_name.master_title_table.ordernumber')}}</th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">{{__('master/masterManager.menu_name.master_title_table.parentid')}}</th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">{{__('master/masterManager.menu_name.master_title_table.action')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             @if($category)
                                                @foreach($category as $row)
                                                    <tr class="odd">
                                                        <td class="dtr-control sorting_1">{{$row->id}}</td>
                                                        <td>{{$row->v_key}}</td>
                                                        <td>{{$row->type}}</td>
                                                        <td>{{$row->v_value}}</td>
                                                        <td>{{$row->v_value_en}}</td>
                                                        <td>{{$row->oder_number}}</td>
                                                        <td>{{$row->parent_id}}</td>
                                                        <td>
                                                        <button type="button" data-toggle="modal" data-target="#editModal3"  class="btn par6" title="update" wire:click="edit({{$row->id}})">
                                                             <img src="/images/pent2.svg" alt="pent">
                                                            </button>
                                                        @include('livewire.common.buttons._delete')

                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>
                                           {{$category->links()}}
                                           @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div wire:ignore.self class="modal fade" id="create_modal" role="dialog" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{__('news/newsManager.menu_name.create-category.title')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true close-btn">×</span>
                            </button>
                        </div>
                        <div class="modal-body container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            {{__('news/newsManager.menu_name.create-category.name')}}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="proposer" class="form-control" wire:model.lazy="name"
                                               placeholder="{{__('news/newsManager.menu_name.create-category.name')}}">
                                        @error('name')
                                        <div class="text-danger mt-1">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="close-academic-create1" wire:click.prevent="resetInputFields()"
                                    class="btn btn-secondary close-btn" data-dismiss="modal">Đóng
                            </button>
                            <button type="button" class="btn btn-primary close-modal"  wire:click.prevent="store()">Lưu
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div wire:ignore.self class="modal fade" id="updateCategory" tabindex="-1" aria-labelledby="exampleModal"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{__('news/newsManager.menu_name.create-category.title')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true close-btn">×</span>
                            </button>
                        </div>
                        <div class="modal-body container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            {{__('news/newsManager.menu_name.create-category.name')}}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="proposer" class="form-control" wire:model.lazy="name"
                                               placeholder="{{__('news/newsManager.menu_name.create-category.name')}}">
                                        @error('name')
                                        <div class="text-danger mt-1">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="close-academic-create1" wire:click.prevent="resetInputFields()"
                                    class="btn btn-secondary close-btn" data-dismiss="modal">Đóng
                            </button>
                            <button type="button" class="btn btn-primary close-modal" wire:click.prevent="update()">Cập nhật
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @include('livewire.admin.config._modalCreate')
            @include('livewire.admin.config._modalEdit')
            @include('livewire.admin.config._modalDeleteSelected')
            @include('livewire.common.modal._modalDelete')
        </div>
    </div>
</section>
<script>
    $("document").ready(() => {
        window.livewire.on('categoryCreate', () => {
            $('#create_modal').modal('hide');
            $('#create_modal').modal('hide').data('bs.modal', null);
            $('#create_modal').remove();
            $('.modal-backdrop').remove();
        });
        window.livewire.on('categoryUpdate', () => {
            $('#updateCategory').modal('hide');
            $('#updateCategory').modal('hide').data('bs.modal', null);
            $('#updateCategory').remove();
            $('.modal-backdrop').remove();
        });

        window.livewire.on('close', () => {
            $('#createModal').click();
            $('#editModal3').click();
       });

    });
</script>
