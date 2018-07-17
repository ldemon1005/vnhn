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
        <div class="box-header with-border">
            <h3 class="box-title">Thêm mới Bài viết </h3>
        </div>
        <section class="content">
            <form id="create_articel" action="{{ url('/admin/articel/action_articel') }}" method="post">
                {{csrf_field()}}
                <div class="row form-group d-none">
                    <label class="col-sm-2">ID video</label>
                    <div class="col-sm-10">
                        <input type="text" name="articel[id]" value="" class="form-control" placeholder="ID danh mục">
                    </div>
                </div>

                <input class="form-check-input" type="radio" value="option1">

                <div class="row form-group">
                    <label class="col-sm-2">Đường dẫn lấy từ</label>
                    <div class="col-sm-10">
                        <div class="row">
                            <label class="col-sm-4 text-primary">
                                <input value="1" type="radio" name="video[type_link]" checked>
                                Video lấy từ máy
                            </label>
                            <label class="col-sm-4 text-primary">
                                <input value="2" type="radio" name="video[type_link]">
                                Video lấy từ youtube
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-sm-2">Tải lên video</label>
                    <div class="col-sm-10">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <button id="upload_video" type="button" class="btn btn-primary">Chọn video từ máy</button>
                            </div>
                            <!-- /btn-group -->
                            <input id="url_video" name="video[url_video]" type="text" class="form-control" placeholder="Đường dẫn video">
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right" style="margin-right: 10px">Tạo mới</button>
                </div>
            </form>
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

        $(document).ready(function() {

        })
    </script>
@stop
