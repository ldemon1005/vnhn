@extends('admin.master')
@section('title', 'Quản trị')
@section('main')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 ">Danh sách Emagazine</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ asset('admin') }}">Home</a></li>
                            <li class="breadcrumb-item active">Danh sách emagazine</li>
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
                        {{-- @if (session('error'))
                            <div class="alert alert-error">
                                <p>{{ session('error') }}</p>
                            </div>
                        @endif

                        @if (session('status'))
                            <div class="alert alert-success">
                                <p>{{ session('status') }}</p>
                            </div>
                        @endif --}}

                        <div class="card-header">
                            <a href="{{ asset('admin/emagazine/add') }}" class="btn btn-primary"><h3 class="card-title">Thêm mới Bài viết</h3></a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="titleTable">Tiêu đề bài viết</th>
                                    <th>Tác giả</th>
                                    <th class="hideResponsive768">Ngày tạo</th>
                                    <th>Avatar</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{$item->e_title}}</td>
                                        <td>{{isset($item->acc)? $item->acc->username : 'Không còn'}}</td>
                                        <td class="hideResponsive768">
                                            {{date_format_vn($item->created_at)}}

                                        </td>
                                        <td>
                                            <div class="avatar">
                                                <img src="{{ file_exists(storage_path('app/emagazine/'.$item->img)) && $item->e_img ? asset('local/storage/app/emagazine/resized-'.$item->e_img) : '../images/default-image.png' }}">
                                            </div>
                                        </td>
                                        <td>
                                           @switch(Auth::user()->level)
                                                @case(1)
                                                     @switch($item->e_status)
                                                        @case(0)
                                                            <button class="btn btn-block btn-sm btn-danger btnStatus" status='1'>Dừng</button>
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
                                                    @switch($item->e_status)
                                                        @case(0)
                                                            <button class="btn btn-block btn-sm btn-danger btnStatus" status="1">Dừng</button>
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
                                                    @switch($item->e_status)
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
                                                    @switch($item->e_status)
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
                                            <div class="id_group" style="display: none;">{{$item->e_id}}</div>
                                        </td>
                                        
                                        <td>
                                            <div class="row form-group">
                                                <a href="{{ asset('admin/emagazine/edit/'.$item->e_id) }}" class="btn btn-sm btn-primary">Sửa</a>

                                                <a href="{{ asset('admin/emagazine/delete/'.$item->e_id) }}" onclick="return confirm('Bạn chắc chắn muốn xóa')" class="btn btn-sm btn-danger" @if ($item->e_status != 0) style="display: none;" @endif> Xóa</a>

                                                    
                                                
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row form-group pull-right" style="margin: 10px 0px">
                                {!! $items->links('vendor.pagination.bootstrap-4') !!}
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
    <div class="modal fade" id="history_articel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    </div>
@stop

@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
@stop

@section('script')
    <!-- Select2 -->
    <script src="plugins/select2/select2.full.min.js"></script>
    <script type="text/javascript" src="js/emagazine.js"></script>
@stop