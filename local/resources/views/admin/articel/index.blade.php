@extends('admin.master')
@section('title', 'Quản trị')
@section('main')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 ">Danh sách Bài viết</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Danh sách bài viết</li>
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
                            <a href="{{route('form_articel',0)}}" class="btn btn-primary"><h3 class="card-title">Thêm mới Bài viết</h3></a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                                <form action="{{ url('/admin/articel') }}" method="get">
                                    <div class="row form-group">
                                        <div class="col-md-4">
                                            <input class="form-control" name="articel[key_search]" placeholder="Từ khóa tìm kiếm">
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-control select2" multiple="multiple"
                                                    data-placeholder="Lọc theo danh mục" name="articel[group_id][]"
                                                    style="width: 100%;">
                                                @foreach($list_group as $group_item)
                                                    <option value="{{ $group_item->id }}">{{ $group_item->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <select class="form-control select2" multiple="multiple"
                                                    data-placeholder="Lọc theo trạng thái" name="articel[status][]"
                                                    style="width: 100%;">
                                                <option value="1">Mới</option>
                                                <option value="2">Chưa duyệt</option>
                                                <option value="3">Đã duyệt</option>
                                                <option value="4">Đã hủy</option>
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
                                    <th style="width: 20%">Tiêu đề bài viết</th>
                                    <th style="width: 20%;">Đường dẫn</th>
                                    <th>Ngày tạo--Ngày update</th>
                                    <th>Avatar</th>
                                    <th>Trạng thái</th>
                                    @if($level < 3)
                                        <th style="min-width: 50px">Duyệt bài</th>
                                    @endif
                                    <th>Thao tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($list_articel as $articel)
                                    <tr>
                                        <td>{{$articel->title}}</td>
                                        <td>{{$articel->slug}}</td>
                                        <td>
                                            {{$articel->created_at}}--{{$articel->updated_at}}
                                        </td>
                                        <td>
                                            <div class="avatar">
                                                <img src="{{ file_exists(resource_path($articel->fimage)) ? asset('/local/resources'.$articel->fimage) : 'http://vietnamhoinhap.vn/'.$articel->fimage }}">
                                            </div>
                                        </td>
                                        <td>{{get_status($articel->status)}}</td>
                                        @if($level < 3)
                                            <td>
                                                <select style="width: 100%" class="form-control"
                                                        onchange="chang_status_articel('{{$articel->id}}',this)">
                                                    @if($level <= 2)
                                                        <option {{$articel->status == 1 ? 'selected' : ''}} value="1">
                                                            Đăng
                                                        </option>
                                                        <option {{$articel->status == 0 ? 'selected' : ''}} value="0">
                                                            Tắt
                                                        </option>
                                                    @endif

                                                    @if($level <= 3)
                                                        <option {{$articel->status == 3 ? 'selected' : ''}} value="3">
                                                            Duyệt lần 1
                                                        </option>
                                                        <option {{$articel->status == 2 ? 'selected' : ''}} value="2">
                                                            Duyệt lần 2
                                                        </option>
                                                        <option {{$articel->status == 4 ? 'selected' : ''}} value="4">
                                                            Trả lại
                                                        </option>
                                                    @endif
                                                </select>
                                            </td>
                                        @endif
                                        <td>
                                            <div class="row form-group">
                                                <a href="{{route('form_articel',$articel->id)}}" data-toggle="tooltip" title="Chỉnh sửa" class="col-sm-4 text-primary"><i class="fa fa-wrench"></i></a>
                                                <a data-toggle="tooltip" title="Xóa" href="{{route('delete_articel',$articel->id)}}" class="col-sm-4 text-danger"><i
                                                            class="fa fa-trash"></i></a>
                                                <a style="cursor: pointer" onclick="historyArticel({{$articel->id}})"   title="Lịch sử" class="col-sm-4 text-dark"><i class="fa fa-book"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row form-group pull-right" style="margin: 10px 0px">
                                {!! $list_articel->links('vendor.pagination.bootstrap-4') !!}
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
@stop