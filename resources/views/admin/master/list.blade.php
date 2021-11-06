<div class="col-md-10 col-xl-11 box-detail box-user list-role">
    <div class="row">
        <div class="col-md-12">
            <div  class="breadcrumbs"><a href="#">{{__('news/newsManager.menu_name.news')}} </a> \ <span>{{__('news/newsManager.menu_name.category_page')}}</span></div>
        </div>
    </div>
    <div class="row bd-border">
        <div class="col-md-12">
            <h3 class="title">Danh Mục Master-Data</h3>
            <div class="information">
                <div class="inner-tab pt0">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="form-group float-right">
                                <button type="button" style="border-radius: 11px; border:none;" data-toggle="modal" data-target="#createModal2">

                                        <img src="/images/filteradd.png" alt="filter-add">

                                </button>
                            </div>
                            <div class="form-group search-expertise float-right" style="margin-right: 12px">
                                <div class="search-expertise" style="    position: relative;">
                                    <input type="text" placeholder="Tìm kiếm" name="search" class="form-control" wire:model.debounce.100ms="searchName" id='input_vn_name' autocomplete="off">
                                    <span style="left: 11px;"><img src="/images/Search.svg" alt="search"/></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                        <tr class="border-radius">
                            <th scope="col" class="border-radius-left"><input type="checkbox"id="selecctall"></th>
                            <th scope="col" class="text-center">ID</th>
                            <th scope="col" class="text-center">V Key</th>
                            <th scope="col">V value </th>
                            <th scope="col">Order Number</th>
                            <th scope="col">Type </th>
                            <th scope="col">V Value En </th>
                            <th scope="col">Parent id </th>
                            <th scope="col">Action </th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($category as $row)
                            <tr>
                                <td class ="text-center"><input type="checkbox"class="checkbox1" name="check[]"></td>
                                <td class="text-center">{{$row->id}}</td>
                                <td>{{$row->v_key}}</td>
                                <td>{{$row->v_value}}</td>
                                <td>{{$row->oder_number}}</td>
                                <td>{{$row->type}}</td>
                                <td>{{$row->v_value_en}}</td>
                                <td>{{$row->parent_id}}</td>
                                <td class="text-center">

                                    <a class="btn par6" data-toggle="modal" data-target="#createModal3"  ><img src="/images/pent2.svg" alt="pent"></a>



                                    <button type="button"   class="btn par6" title="delete">
                                       <a href="{{route('admin.config.master.delete',[$row->id])}}"> <img src="/images/trash.svg" alt="trash"></a>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @if(count($category) > 0)
                        {{$category->links()}}
                    @else
                        <div class="title-approve text-center">
                            <span>{{__('data_field_name.system.role.no_result')}}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{--dialog box--}}

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
    <div wire:ignore.self class="modal fade" id="exampleDelete" tabindex="-1" aria-labelledby="exampleModal"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body box-user">
                    <h4 class="modal-title">{{__('data_field_name.common_field.confirm_delete')}}</h4>
                    {{__('notification.member.warning.warning-1')}} <br>
                    <span class="text-danger">{{__('news/newsManager.menu_name.delete-category.warning')}}</span>
                </div>
                <div class="group-btn2 text-center pt-24">
                    <button type="button" class="btn btn-cancel" data-dismiss="modal" wire:click="resetInputFields" >Quay lại</button>
                    <button type="button" wire:click.prevent="delete()" class="btn btn-save" data-dismiss="modal">
                        Xóa
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

</div>

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
    });

</script>
