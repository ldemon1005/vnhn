@extends('admin.master')
@section('title', 'Quản trị')
@section('main')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 ">Danh sách videos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ asset('admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">Danh sách video</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @if (session('error'))
                    <div class="alert alert-error">
                        <p>{{ session('error') }}</p>
                    </div>
                    @endif

                    @if (session('status'))
                    <div class="alert alert-success">
                        <p>{{ session('status') }}</p>
                    </div>
                    @endif

                    <div class="card-header">
                        <a href="{{route('form_video',0)}}" class="btn btn-primary"><h3 class="card-title">Thêm mới Video</h3></a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="{{ url('/admin/video') }}" method="get">
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <input class="form-control" name="video[key_search]" placeholder="Từ khóa tìm kiếm">
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control select2" multiple="multiple"
                                    data-placeholder="Lọc theo danh mục" name="video[group_id][]"
                                    style="width: 100%;">
                                    @foreach($list_group as $group_item)
                                    <option value="{{ $group_item->id }}">{{ $group_item->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <select class="form-control select2" multiple="multiple"
                                data-placeholder="Lọc theo trạng thái" name="video[status][]"
                                style="width: 100%;">
                                <option value="2">Chờ duyệt</option>
                                <option value="1">Đã duyệt</option>
                                <option value="0">Gỡ xuống</option>
                            </select>
                        </div>
                        <div class="col-md-2 float-right">
                            <button class="btn btn-primary float-right" type="submit"><i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width: 30%">Tiêu đề video</th>
                            <th class="hideResponsive768">Đường dẫn</th>
                            <th class="hideResponsive768">Ngày tạo--Ngày update</th>
                            {{--<th>Avatar</th>--}}
                            <th style="width: 8%">Trạng thái</th>
                            <th style="width: 10%">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($list_video as $video)
                        <tr>
                            <td class="titleTable">{{$video->title}}</td>
                            <td class="hideResponsive768">{{$video->slug}}</td>
                            <td class="hideResponsive768">
                                {{$video->created_at}}--{{$video->updated_at}}
                            </td>
                            {{--<td>--}}
                                {{--<img style="height: 50px" src="{{ isset($video->avatar) && file_exists(resource_path($video->avatar)) && $video->avatar ? asset('local/resources'.$video->avatar) : '../images/default-image.png' }}">--}}
                                {{-- {{ isset($video->avatar) && file_exists(resource_path($video->avatar)) && $video->avatar ? asset('local/resource'.$video->avatar) : '../images/default-image.png' }} --}}
                            {{--</td>--}}
                            <td id="status_video">
                                {{-- <button onclick="change_status({{$video->id}},{{$video->status}})" id="status_video" class="btn btn-block btn-sm {{ $video->status == 0 ? 'btn-danger' : 'btn-success' }}">{{ $video->status == 0 ? 'Chưa duyệt' : 'Đã duyệt' }}</button> --}}
                                @switch(Auth::user()->level)
                                    @case(1)
                                         @switch($video->status)
                                            @case(0)
                                                <button class="btn btn-block btn-sm btn-default btnStatus" status='1'>Dừng</button>
                                                @break
                                            @case(1)
                                                <button class="btn btn-block btn-sm btn-default btnStatus" status='0'>Đang chạy</button>
                                                @break
                                            @case(2)
                                                <button class="btn btn-block btn-sm btn-success btnStatus" status='1'>Duyệt</button>
                                                @break
                                            @default
                                                <button class="btn btn-block btn-sm btn-danger">Lỗi</button>
                                                @break
                                        @endswitch
                                        @break
                                    @case(2) 
                                        @switch($video->status)
                                            @case(0)
                                                <button class="btn btn-block btn-sm btn-default btnStatus" status="1">Dừng</button>
                                                @break
                                            @case(1)
                                                <button class="btn btn-block btn-sm btn-default btnStatus" status="0">Đang chạy</button>
                                                @break
                                            @case(2)
                                                <button class="btn btn-block btn-sm btn-success btnStatus" status="1">Duyệt</button>
                                                <button class="btn btn-block btn-sm btn-info btnStatus" status="3">Trả lại</button>
                                                @break
                                            @default
                                                <button class="btn btn-block btn-sm btn-danger">Lỗi</button>
                                                @break
                                        @endswitch
                                        @break
                                    @case(3)
                                        @switch($video->status)
                                            @case(2)
                                                <button class="btn btn-block btn-sm btn-default">Chờ Duyệt</button>
                                                @break
                                            @case(3)
                                                <button class="btn btn-block btn-sm btn-info btnStatus" status="2">Gửi lại</button>
                                                @break
                                            @default
                                                <button class="btn btn-block btn-sm btn-danger">Lỗi</button>
                                                @break
                                        @endswitch
                                        @break
                                     @case(4)
                                        @switch($video->status)
                                            @case(2)
                                                <button class="btn btn-block btn-sm btn-default">Chờ Duyệt</button>
                                                @break
                                            @case(3)
                                                <button class="btn btn-block btn-sm btn-info btnStatus" status="2">Gửi lại</button>
                                                @break
                                            @default
                                                <button class="btn btn-block btn-sm btn-danger">Lỗi</button>
                                                @break
                                        @endswitch
                                        @break
                                    @default
                                        <button class="btn btn-block btn-sm btn-danger">Lỗi</button>
                                        @break
                                @endswitch
                                <div class="id_group" style="display: none;">{{$video->id}}</div>
                            </td>
                            <td>
                                <div class="row form-group text-center">
                                    <a href="{{route('form_video',$video->id)}}" data-toggle="tooltip" title="Chỉnh sửa" class="col-sm-4 text-primary"><i class="fa fa-wrench"></i></a>
                                    <a data-toggle="tooltip" title="Xóa" onclick="return confirm('Bạn có chắc chắn xóa? Một số dữ liệu sẽ không thể khôi phục!')" href="{{route('delete_video',$video->id)}}" class="col-sm-4 text-danger" @if ($video->status != 0 ) style="display: none" @endif><i
                                        class="fa fa-trash"></i></a>
                                    <a style="cursor: pointer" onclick="historyVideo({{$video->id}})"   title="Lịch sử" class="col-sm-4 text-dark"><i class="fa fa-book"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row form-group pull-right" style="margin: 10px 0px">
                        {!! $list_video->links('vendor.pagination.bootstrap-4') !!}
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
</div>



<!-- Modal -->
<div class="modal fade" id="history_video" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

</div>
@stop

@section('css')
<!-- Select2 -->
<link rel="stylesheet" href="plugins/select2/select2.min.css">
@stop

@section('script')
<!-- Select2 -->
<script src="plugins/select2/select2.full.min.js"></script>
<script type="text/javascript" src="js/video.js"></script>
@stop