@extends('admin.master')
@section('title', 'Quản trị')
@section('main')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 ">Danh sách Magazine</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ asset('admin') }}">Home</a></li>
                            <li class="breadcrumb-item active">Danh sách magazine</li>
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
                        @if (session('status'))
                            <div class="alert alert-success">
                                <p>{{ session('status') }}</p>
                            </div>
                        @endif

                        <div class="card-header">
                            <a href="{{route('form_magazine',0)}}" class="btn btn-primary"><h3 class="card-title">Thêm mới Magazine</h3></a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="titleTable">Tiêu đề</th>
                                    <th class="hideResponsive768">Đường dẫn</th>
                                    <th>Ngày tạo</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($list_magazine as $magazine)
                                    <tr>
                                        <td>{{$magazine->title}}</td>
                                        <td class="hideResponsive768">{{$magazine->slug}}</td>
                                        <td>
                                            {{$magazine->created_at}}
                                        </td>
                                        <td>
                                            <button class="btn btn-block btn-sm {{ $magazine->status == 0 ? 'btn-danger' : 'btn-success' }}">{{ $magazine->status == 0 ? 'Chưa duyệt' : 'Đã duyệt' }}</button>
                                        </td>
                                        <td>
                                            <div class="row form-group text-center">
                                                <a href="{{route('form_magazine',$magazine->id)}}" data-toggle="tooltip" title="Chỉnh sửa" class="col-sm-4 text-primary"><i class="fa fa-wrench"></i></a>
                                                <a data-toggle="tooltip" title="Xóa" onclick="return confirm('Bạn có chắc chắn xóa? Một số dữ liệu sẽ không thể khôi phục!')" href="{{route('delete_magazine',$magazine->id)}}" class="col-sm-4 text-danger"><i
                                                            class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row form-group pull-right" style="margin: 10px 0px">
                                {!! $list_magazine->links('vendor.pagination.bootstrap-4') !!}
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
@stop