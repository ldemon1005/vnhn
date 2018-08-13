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
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>{{ $articel->id == 0? 'Thêm mới ': 'Chỉnh sửa '}}Bài viết</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ asset('admin') }}">Trang chủ</a></li>
                  <li class="breadcrumb-item"><a href="{{ asset('admin/articel') }}">Bài viết</a></li>
                  <li class="breadcrumb-item active">{{ $articel->id == 0? 'Thêm mới ': 'Chỉnh sửa '}}</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <!-- left column -->
              <div class="col-md-12 col-sm-12">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">{{ $articel->id == 0? 'Thêm mới ': 'Chỉnh sửa '}}</h3>
                    </div>
                    <form id="create_articel" action="{{ url('/admin/articel/action_articel') }}" method="post" enctype="multipart/form-data" >
                        {{csrf_field()}}
                        <div class="card-body">
                            <div class="row form-group d-none">
                                <label class="col-sm-2">ID bài viết</label>
                                <div class="col-sm-10">
                                    <input type="text" name="articel[id]" value="{{$articel->id}}" class="form-control" placeholder="ID danh mục">
                                </div>
                            </div>

                                    <div class="row form-group">
                                        <label class="col-sm-2">Tiêu đề bài viết <span class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="text" name="articel[title]" required value="{{$articel->title}}"
                                                   class="form-control" placeholder="Tiêu đề bài viết">
                                        </div>
                                    </div>

                                    {{-- <div class="row form-group">
                                        <label class="col-sm-2">Tiêu đề phụ</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="articel[titlephu]" value="{{$articel->titlephu}}" class="form-control" placeholder="Tiêu đề phụ">
                                        </div>
                                    </div> --}}

                                    
                                    <div class="row form-group">
                                        <label class="col-sm-2">Ngày phát hành <span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input type="date" name="articel[release_time][day]" required
                                                   value="{{$articel->release_time->day}}" min="1000-01-01"
                                                   max="3000-12-31" class="form-control">
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="bootstrap-timepicker">
                                                <div class="input-group">
                                                    <input type="text" name="articel[release_time][h]"
                                                           value="{{$articel->release_time->h}}" class="form-control timepicker">

                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                                    </div>
                                                </div>
                                                <!-- /.form group -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <label class="col-sm-2">Danh mục tin <span class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" multiple="multiple" data-placeholder="Chọn danh mục" name="articel[groupid][]" required
                                                    style="width: 100%;">
                                                @foreach($list_group as $articel_item)
                                                    <option {{in_array($articel_item->id,$articel->groupid) ? 'selected' : ''}} value="{{ $articel_item->id }}">{{ $articel_item->title }}</option>
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
                                        <label class="col-sm-2">Ảnh đại diện</label>
                                        <div class="col-sm-3 form-group">
                                            <input id="img" type="file" name="img" class="cssInput" onchange="changeImg(this)" style="display: none!important;">
                                            <img style="cursor: pointer;max-width: 100%;max-height: 300px;" id="avatar" class="cssInput thumbnail imageForm" src="
                                                {{ isset($articel->fimage)  && $articel->fimage ?
                                                    (file_exists(storage_path('app/article/resized500-'.$articel->fimage)) ?
                                                        asset('local/storage/app/article/resized500-'.$articel->fimage) :
                                                        (file_exists(resource_path($articel->fimage)) ?
                                                            asset('/local/resources'.$articel->fimage) :
                                                            '../images/default-image.png')) :
                                                '../images/default-image.png' }}">
                                            {{-- <div class="{{ $articel->fimage == null  ? '' : 'd-none' }} blog-avatar boxborder text-center justify-content-center align-items-center pointer"
                                                 onclick="avatar.click()">
                                                <div class="d-inline-block" style="margin: auto">
                                                    <img style="width: 60%" src="{{asset('/local/resources/assets/images/add_image_icon.png')}}" title="Thêm ảnh avatar">
                                                </div>
                                            </div>
                                            <div class="img-avatar {{ $articel->fimage == null  ? 'd-none' : '' }}" style="position: relative;width: 100%">
                                                <img id="blog_avatar" style="width: 100%" src="{{ file_exists(resource_path($articel->fimage)) ? asset('/local/resources'.$articel->fimage) : (file_exists('http://vietnamhoinhap.vn/'.$articel->fimage) ? 'http://vietnamhoinhap.vn/'.$articel->fimage : '../images/default-image.png' )}}" alt="">
                                                <i class="fa fa-trash text-danger pointer" style="position: absolute;top: 10px;right: 15px"
                                                   onclick="removeImage()"></i>
                                            </div>
                                            <input #avatar class="d-none" type="file" id="avatar"
                                                   onchange="uploadImage(avatar,avatar.files[0])">
                                            <input class="d-none" name="articel[fimage]" value="{{$articel->fimage}}" id="src_avatar" type="text"> --}}
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
                                                <textarea id="editor1" name="articel[content]" rows="10" cols="80">
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
                                        <label class="col-sm-2">Hiển thị</label>
                                        <div class="col-sm-10">
                                            <div class="row form-group">
                                                <label class="col-sm-6">
                                                    <input type="checkbox" value="1" onclick="hot_main($(this).is(':checked'))" class="minimal" name="articel[hot_main]" {{$articel->hot_main == 1 ? 'checked' : ''}}>
                                                    Hot trang chủ trong
                                                    <input type="number" name="articel[time_hot_main]" class="" placeholder="24" id="hot-main">
                                                    giờ
                                                </label>

                                                {{-- <div class="col-sm-2" id="hot-main">
                                                    <input name="articel[time_hot_main]" class="form-control" placeholder="giờ">
                                                </div>
 --}}
                                                <label class="col-sm-6">
                                                    <input type="checkbox" value="1" onclick="hot_item($(this).is(':checked'))" class="minimal" name="articel[hot_item]" {{$articel->hot_item == 1 ? 'checked' : ''}}>
                                                    Hot danh mục trong
                                                    <input type="number" name="articel[time_hot_item]" class="" placeholder="24" id="hot-item">
                                                    giờ
                                                </label>

                                                {{-- <div class="col-sm-2 d-none" id="hot-item">
                                                    
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-2">Description meta</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="articel[description_meta]" value="{{$articel->description_meta}}" class="form-control" placeholder="Description meta">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-2">Keyword meta</label>
                                        <div class="col-sm-10">
                                            <textarea type="text" name="articel[keyword_meta]" class="form-control" placeholder="Keywords meta bài viết">{{$articel->keyword_meta}}</textarea>
                                        </div>
                                    </div>
                                    {{--<div class="row form-group">--}}
                                        {{--<label class="col-sm-2">Loại</label>--}}
                                        {{--<div class="col-sm-10">--}}
                                            {{--<select class="form-control" name="articel[loaiview]">--}}
                                                {{--<option value="0">Không chọn</option>--}}
                                                {{--<option value="1">Video</option>--}}
                                                {{--<option value="2">Ảnh</option>--}}
                                                {{--<option value="3">Âm thanh</option>--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                    <div class="row form-group">
                                        <label class="col-sm-2">Loại tin bài</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="articel[loaitinbai]">
                                                <option value="1">Tổng hợp</option>
                                                <option value="2">Tự viết</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-info pull-right" style="margin-right: 10px">{{ $articel->id ? 'Cập nhật' : 'Tạo mới' }}</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./row -->
    </div>
@stop

@section('script')
    <script src="plugins/ckeditor/ckeditor.js"></script>
    <script>
        $(function () {
            CKEDITOR.replace( 'editor1', {
                height: '400px',
                filebrowserBrowseUrl: 'plugins/ckfinder/ckfinder.html',
                filebrowserImageBrowseUrl: 'plugins/ckfinder/ckfinder.html?type=Images',
                filebrowserFlashBrowseUrl: 'plugins/ckfinder/ckfinder.html?type=Flash',
                filebrowserUploadUrl: 'plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                filebrowserImageUploadUrl: 'plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                filebrowserFlashUploadUrl: 'plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
            } );

            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass   : 'iradio_minimal-blue'
            })
        });
        $(document).ready(function(){
            if ($('input[name="articel[hot_main]"]').attr('checked')) {
                $("#hot-main").prop('disabled', false);
            }else{
                $("#hot-main").prop('disabled', true);
            }

            if ($('input[name="articel[hot_item]"]').attr('checked')) {
                $("#hot-item").prop('disabled', false);
            }else{
                $("#hot-item").prop('disabled', true);
            }
            
            // $("#hot-item").prop('disabled', true);
        });
            
        function hot_main(a) {
            if(a){
                // $('#hot-main').removeClass('d-none');
                $("#hot-main").prop('disabled', false);
                // document.getElementById("hot-main").disabled = false;
            }else {
                $("#hot-main").prop('disabled', true);
                // document.getElementById("hot-main").disabled = true;
                // $('#hot-main').addClass('d-none');
            }
        }

        function hot_item(a) {
            if(a){
                $('#hot-item').prop('disabled', false);
            }else {
                $('#hot-item').prop('disabled', true);
            }
        }
    </script>

    <script>
        $("#create_articel").validate({
            ignore: [],
            rules: {
                'articel[title]': {
                    required: true
                    // maxlength : 80
                },
                'articel[release_time][day]': {
                    required: true
                },
                'articel[release_time][h]': {
                    required: true
                },
                'articel[groupid][]': {
                    required: true
                },
                // 'articel[summary]': {
                //     maxlength : 200
                // }
            },
            messages: {
                'articel[title]': {
                    required: 'Vui lòng nhập tên danh mục'
                    // maxlength : 'Tiều đề không được quá 80 ký tự'
                },
                'articel[release_time][day]': {
                    required: 'Thiếu ngày phát hành'
                },
                'articel[release_time][h]': {
                    required: 'Thiếu giờ phát hành'
                },
                'articel[groupid][]': {
                    required: 'Thiếu nhóm tin tức'
                },
                // 'articel[summary]': {
                //     maxlength : 'Mô tả không được quá 200 ký tự'
                // }
            }
        });
    </script>
@stop
