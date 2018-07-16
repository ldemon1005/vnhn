@extends('admin.master')

@section('css')
    <!-- Select2 -->

@stop
@section('main')
    @if (session('error'))
        <div class="alert alert-error">
            <p>{{ session('error') }}</p>
        </div>
    @endif
    <div class="content-wrapper">
        <div class="box-header with-border">
            <h3 class="box-title">Thêm mới Danh mục </h3>
        </div>
        <section class="content">
            <form id="create_group" action="{{ url('/admin/action_group') }}" method="post">
                {{csrf_field()}}
                <div class="row form-group d-none">
                    <label class="col-sm-2">ID danh mục</label>
                    <div class="col-sm-10">
                        <input type="text" name="group[id]" value="{{$group->id}}" class="form-control" placeholder="ID danh mục">
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-sm-2">Tên danh mục</label>
                    <div class="col-sm-10">
                        <input type="text" name="group[title]" value="{{$group->title}}" class="form-control" placeholder="Tên danh mục">
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-2">Danh mục cha</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" data-placeholder="Chọn danh mục cha" name="group[parentid]"
                                style="width: 100%;">
                            @foreach($list_group as $group_item)
                                <option {{$group->parentid == $group_item->id ? 'selected' : ''}} value="{{ $group_item->id }}">{{ $group_item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-2">Mô tả danh mục</label>
                    <div class="col-sm-10">
                        <textarea type="text" name="group[summary]" class="form-control" placeholder="Mô tả danh mục">{{$group->summary}}</textarea>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-sm-2">Keywords</label>
                    <div class="col-sm-10">
                        <textarea type="text" name="group[keywords]" class="form-control" placeholder="Keywords danh mục">{{$group->keywords}}</textarea>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-sm-2">Titlemeta</label>
                    <div class="col-sm-10">
                        <textarea type="text" name="group[titlemeta]" class="form-control" placeholder="Titlemeta danh mục">{{$group->titlemeta}}</textarea>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-sm-2">Avatar</label>
                    <div class="col-sm-3 form-group">
                        <div class="{{ $group->avatar == null  ? '' : 'd-none' }} blog-avatar boxborder text-center justify-content-center align-items-center pointer"
                             onclick="avatar.click()">
                            <div class="d-inline-block" style="margin: auto">
                                <img style="width: 60%" src="{{asset('/local/resources/assets/images/add_image_icon.png')}}" title="Thêm ảnh avatar">
                            </div>
                        </div>
                        <div class="img-avatar {{ $group->avatar == null  ? 'd-none' : '' }}" style="position: relative;width: 100%">
                            <img id="blog_avatar" style="width: 100%" src="{{asset("/local/resources".$group->avatar)}}" alt="">
                            <i class="fa fa-trash text-danger pointer" style="position: absolute;top: 10px;right: 15px"
                               onclick="removeImage()"></i>
                        </div>
                        <input #avatar class="d-none" type="file" id="avatar"
                               onchange="uploadImage(avatar,avatar.files[0])">
                        <input class="d-none" name="group[avatar]" value="{{$group->avatar}}" id="src_avatar" type="text">
                    </div>
                </div>


                <div class="row form-group">
                    <label class="col-sm-2">Trạng thái</label>
                    <div class="col-sm-10">
                        <div class="row">
                            <label class="col-sm-3 text-primary">
                                <input value="2" type="radio" name="group[status]" {{ $group->status != 2 ? 'checked' : '' }}>
                                Hoạt động
                            </label>
                            <label class="col-sm-3 text-primary">
                                <input value="1" type="radio" name="group[status]" {{ $group->status == 2 ? 'checked' : '' }}>
                                Không hoạt động
                            </label>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right" style="margin-right: 10px">{{ $group->id ? 'Cập nhật' : 'Tạo mới' }}</button>
                </div>
            </form>
            <!-- ./row -->
        </section>
    </div>
@stop

@section('script')
    <!-- Select2 -->
    <script src="plugins/select2/select2.full.min.js"></script>
@stop
