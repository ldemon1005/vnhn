@extends('admin.master')

@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
@stop
@section('main')
    @if (session('error'))
        <div class="alert alert-error">
            <p>{{ session('error') }}</p>
        </div>
    @endif
    <div class="content-wrapper">
        <div class="box-header with-border">
            <h3 class="box-title">Thêm mới Bài viết </h3>
        </div>
        <section class="content">
            <form id="create_group" action="{{ url('/admin/action_group') }}" method="post">
                {{csrf_field()}}
                <div class="row form-group d-none">
                    <label class="col-sm-2">ID bài viết</label>
                    <div class="col-sm-10">
                        <input type="text" name="group[id]" value="{{$articel->id}}" class="form-control" placeholder="ID danh mục">
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-sm-2">Tiêu đề bài viết</label>
                    <div class="col-sm-10">
                        <input type="text" name="articel[title]" value="{{$articel->title}}" class="form-control" placeholder="Tiêu đề bài viết">
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-sm-2">Tiêu đề phụ</label>
                    <div class="col-sm-10">
                        <input type="text" name="articel[titlephu]" value="{{$articel->titlephu}}" class="form-control" placeholder="Tiêu đề phụ">
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-sm-2">Từ khóa</label>
                    <div class="col-sm-10">
                        <input type="text" name="articel[keywords]" value="{{$articel->keywords}}" class="form-control" placeholder="Từ khóa">
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-sm-2">Description meta</label>
                    <div class="col-sm-10">
                        <input type="text" name="articel[description_meta]" value="{{$articel->description_meta}}" class="form-control" placeholder="Description meta">
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-sm-2">Ngày phát hành</label>
                    <div class="col-sm-8">
                        <input type="date" name="articel[release_time][day]" min="1000-01-01"
                               max="3000-12-31" class="form-control">
                    </div>
                    <div class="col-sm-2">
                        <div class="bootstrap-timepicker">
                            <div class="input-group">
                                <input type="text" name="articel[release_time][h]" class="form-control timepicker">

                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                </div>
                            </div>
                            <!-- /.form group -->
                        </div>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-sm-2">Danh mục tin</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" multiple="multiple" data-placeholder="Chọn danh mục" name="articel[groupid][]"
                                style="width: 100%;">
                            @foreach($list_group as $articel_item)
                                <option value="{{ $articel_item->id }}">{{ $articel_item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-2">Tóm tắt</label>
                    <div class="col-sm-10">
                        <textarea type="text" name="articel[summary]" class="form-control" placeholder="Mô tả">{{$articel->summary}}</textarea>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-sm-2">Keywords</label>
                    <div class="col-sm-10">
                        <textarea type="text" name="articel[keywords]" class="form-control" placeholder="Keywords bài viết">{{$articel->keywords}}</textarea>
                    </div>
                </div>


                <div class="row form-group">
                    <label class="col-sm-2">Avatar</label>
                    <div class="col-sm-3 form-group">
                        <div class="{{ $articel->avatar == null  ? '' : 'd-none' }} blog-avatar boxborder text-center justify-content-center align-items-center pointer"
                             onclick="avatar.click()">
                            <div class="d-inline-block" style="margin: auto">
                                <img style="width: 60%" src="{{asset('/local/resources/assets/images/add_image_icon.png')}}" title="Thêm ảnh avatar">
                            </div>
                        </div>
                        <div class="img-avatar {{ $articel->avatar == null  ? 'd-none' : '' }}" style="position: relative;width: 100%">
                            <img id="blog_avatar" style="width: 100%" src="{{asset("/local/resources".$articel->avatar)}}" alt="">
                            <i class="fa fa-trash text-danger pointer" style="position: absolute;top: 10px;right: 15px"
                               onclick="removeImage()"></i>
                        </div>
                        <input #avatar class="d-none" type="file" id="avatar"
                               onchange="uploadImage(avatar,avatar.files[0])">
                        <input class="d-none" name="group[avatar]" value="{{$articel->avatar}}" id="src_avatar" type="text">
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-sm-2">Keywords</label>
                    <div class="col-sm-10">
                        <textarea type="text" name="articel[keywords]" class="form-control" placeholder="Keywords bài viết">{{$articel->keywords}}</textarea>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-sm-2">Nội dung bài viết</label>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-info">
                                    <!-- /.box-header -->
                                    <div class="box-body pad">
                                    <textarea id="editor1" name="editor1" rows="10" cols="80">
                                        {{ $articel->content != '' ? $articel->content : 'Nội dung bài viết' }}
                                    </textarea>

                                    </div>
                                </div>
                                <!-- /.box -->
                            </div>
                            <!-- /.col-->
                        </div>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-sm-2">Tác giả</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="articel[tacgia]" value="{{$articel->tacgia}}">
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-sm-2">Nguồn tin</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="articel[nguontin]" value="{{$articel->nguontin}}">
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-sm-2">Link nguồn</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="articel[url_nguon]" value="{{$articel->url_nguon}}">
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-sm-2">Loại</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="articel[loaiview]">
                            <option value="0">Không chọn</option>
                            <option value="1">Video</option>
                            <option value="2">Ảnh</option>
                            <option value="3">Âm thanh</option>
                        </select>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right" style="margin-right: 10px">{{ $articel->id ? 'Cập nhật' : 'Tạo mới' }}</button>
                </div>
            </form>
            <!-- ./row -->
        </section>
    </div>
@stop

@section('script')

@stop
