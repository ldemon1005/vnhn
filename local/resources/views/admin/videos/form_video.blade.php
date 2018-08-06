@extends('admin.master')

@section('css')
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
            <h1>{{isset($video) && $video->id != 0? 'Thay đổi' : 'Thêm mới'}} video</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ asset('admin') }}">Trang chủ</a></li>
              <li class="breadcrumb-item"><a href="{{ asset('admin/video') }}">Video</a></li>
              <li class="breadcrumb-item active">{{isset($video) && $video->id != 0? 'Thay đổi' : 'Thêm mới'}}</li>
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
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">{{isset($video) && $video->id != 0? 'Thay đổi' : 'Thêm mới'}}</h3>
                </div>
                <form id="create_video" action="{{ url('/admin/video/action_video') }}" method="post">
                    {{csrf_field()}}
                    <div class="card-body">
                        <div class="row form-group d-none">
                            <label class="col-sm-2">ID video</label>
                            <div class="col-sm-10">
                                <input type="text" name="video[id]" value="{{$video->id}}" class="form-control" placeholder="ID danh mục">
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-sm-2">
                                Tiêu đề video <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="video[title]" value="{{$video->title}}">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-sm-2">Video dẫn lấy từ</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <label class="col-sm-4 text-primary">
                                        <input value="1" type="radio" name="video[type_link]" {{$video->type_link == 1 ? 'checked' : ''}} onclick="urlVideo(this.value)">
                                        Video lấy từ máy
                                    </label>
                                    <label class="col-sm-4 text-primary">
                                        <input value="2" type="radio" name="video[type_link]" {{$video->type_link != 1 ? 'checked' : ''}} onclick="urlVideo(this.value)">
                                        Video lấy từ youtube
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-sm-2">Tải lên video <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button id="upload_video" type="button" class="btn btn-primary {{$video->type_link != 1 ? 'd-none' : ''}}">Chọn video từ máy</button>
                                    </div>
                                    <!-- /btn-group -->
                                    <input id="url_video" name="video[url_video]" value="{{$video->url_video}}" type="text" class="form-control" placeholder="Đường dẫn video">
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-sm-2">Ngày phát hành <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="date" name="video[release_time][day]" value="{{$video->release_time->day}}" min="1000-01-01"
                                       max="3000-12-31" class="form-control">
                            </div>
                            <div class="col-sm-2">
                                <div class="bootstrap-timepicker">
                                    <div class="input-group">
                                        <input type="text" name="video[release_time][h]" value="{{$video->release_time->h}}" class="form-control timepicker">

                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                        </div>
                                    </div>
                                    <!-- /.form group -->
                                </div>
                            </div>
                        </div>

                        {{--<div class="row form-group">--}}
                            {{--<label class="col-sm-2">Avatar</label>--}}
                            {{--<div class="col-sm-3 form-group">--}}
                                {{--<div class="{{ $video->avatar == null  ? '' : 'd-none' }} blog-avatar boxborder text-center justify-content-center align-items-center pointer"--}}
                                     {{--onclick="avatar.click()">--}}
                                    {{--<div class="d-inline-block" style="margin: auto">--}}
                                        {{--<img style="width: 60%" src="{{asset('/local/resources/assets/images/add_image_icon.png')}}" title="Thêm ảnh avatar">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="img-avatar {{ $video->avatar == null  ? 'd-none' : '' }}" style="position: relative;width: 100%">--}}
                                    {{--<img id="blog_avatar" style="width: 100%" src="{{asset("/local/resources".$video->avatar)}}" alt="">--}}
                                    {{--<i class="fa fa-trash text-danger pointer" style="position: absolute;top: 10px;right: 15px"--}}
                                       {{--onclick="removeImage()"></i>--}}
                                {{--</div>--}}
                                {{--<input #avatar class="d-none" type="file" id="avatar"--}}
                                       {{--onchange="uploadImage(avatar,avatar.files[0])">--}}
                                {{--<input class="d-none" name="video[avatar]" value="{{$video->avatar}}" id="src_avatar" type="text">--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <div class="row form-group">
                            <label class="col-sm-2">Danh mục video <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select class="form-control select2" multiple="multiple" data-placeholder="Chọn danh mục" name="video[groupid][]"
                                        style="width: 100%;">
                                    @foreach($list_group as $articel_item)
                                        <option {{in_array($articel_item->id,$video->groupid) ? 'selected' : ''}} value="{{ $articel_item->id }}">{{ $articel_item->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-sm-2">
                                Mô tả<span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="video[summary]">{{$video->summary}}</textarea>
                            </div>
                        </div>

                        <div class="row" style="margin: 20px 0px">
                            <div class="col-sm-6 text-danger">Thông tin SEO</div>
                        </div>

                        <div class="row form-group">
                            <label class="col-sm-2">Keywords </label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="video[keywords]" value="{{$video->keywords}}">
                                    </div>
                                    <div class="col-sm-12">
                                        <span class="text-danger" style="font-style: italic">Tối đa 4 từ khóa, ngăn cách dấu "-"</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-sm-2">Description </label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="video[description]" value="{{$video->description}}">
                                    </div>
                                    <div class="col-sm-12">
                                        <span class="text-danger" style="font-style: italic">Tối đa 160 ký tự</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-sm-2">SeoTitle </label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="video[seo_title]" value="{{$video->seo_title}}">
                                    </div>
                                    <div class="col-sm-12">
                                        <span class="text-danger" style="font-style: italic">Tối đa 70 ký tự</span>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                        
                    <div class="box-footer card-footer">
                        <button type="submit" class="btn btn-info pull-right" style="margin-right: 10px">{{$video->id ? 'Cập nhật' : 'Tạo mới'}}</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>
            <!-- ./row -->
    </section>
    </div>
@stop

@section('script')
    <script src="plugins/ckfinder/ckfinder.js"></script>
    <script>
        var button1 = document.getElementById( 'upload_video' );

        button1.onclick = function() {
            selectFileWithCKFinder( 'url_video' );
        };

        function selectFileWithCKFinder( elementId ) {
            CKFinder.modal( {
                chooseFiles: true,
                width: 800,
                height: 600,
                onInit: function( finder ) {
                    finder.on( 'files:choose', function( evt ) {
                        var file = evt.data.files.first();
                        var output = document.getElementById( elementId );
                        output.value = file.getUrl();
                        console.log(1,file)
                    } );

                    finder.on( 'file:choose:resizedImage', function( evt ) {
                        var output = document.getElementById( elementId );
                        output.value = evt.data.resizedUrl;
                        console.log(2,evt.data.resizedUrl)
                    } );
                }
            } );
        }

        function urlVideo(type) {
            if(type == 1){
                $('#upload_video').removeClass('d-none')
            }else {
                $('#upload_video').addClass('d-none')
            }
        }
    </script>

    <script>
        $("#create_video").validate({
            ignore: [],
            rules: {
                'video[title]': {
                    required: true
                },
                'video[url_video]': {
                    required: true
                },
                'video[release_time][day]': {
                    required: true
                },
                'video[release_time][h]': {
                    required: true
                },
                'video[summary]': {
                    required: true
                },
                'video[groupid][]': {
                    required: true
                }
            },
            messages: {
                'video[title]': {
                    required: 'Vui lòng nhập tên danh mục'
                },
                'video[url_video]': {
                    required: 'Thiếu đường dẫn video'
                },
                'video[release_time][day]': {
                    required: 'Thiếu ngày phát hành'
                },
                'video[release_time][h]': {
                    required: 'Thiếu giờ phát hàng'
                },
                'video[summary]': {
                    required: "Thiếu mô tả"
                },
                'video[groupid][]': {
                    required: 'Thiếu danh mục video'
                }
            }
        });
    </script>
@stop
