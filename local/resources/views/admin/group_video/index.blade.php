@extends('admin.master')
@section('title', 'Quản trị')
@section('main')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 ">Danh sách Danh mục video</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ asset('admin') }}">Home</a></li>
                            <li class="breadcrumb-item active">Danh sách danh mục video</li>
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
                                <div class="row form-group">
                                    <div class="col-md-2">
                                        @if (Auth::user()->site == 1)
                                            <a style="cursor: pointer;color: #ffffff" onclick="add_menu_video(0)"
                                               class="btn
                                            btn-primary">
                                                <h3 class="card-title">Thêm mới</h3></a>
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                        @if (Auth::user()->site == 1)
                                            <a href="{{route('form_sort')}}"
                                               class="btn btn-primary">
                                                <h3 class="card-title">Sắp xếp</h3></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Tên danh mục</th>
                                    <th>icon</th>
                                    <th>Ngày tạo</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($list_group as $group)
                                    <tr>
                                        <td>{{$group->title}}</td>
                                        <td><i class="{{$group->icon}}"></i> &nbsp;&nbsp;  {{$group->icon}}</td>
                                        <td>{{$group->created_at}}</td>
                                        <td>
                                            <button class="btn btn-block btn-sm {{ $group->status == 0 ? 'btn-danger btnOn' : 'btn-success btnOff' }}">{{ $group->status ? ' Hoạt động' : 'Không hoạt động' }}</button>
                                            <div class="id_group" style="display: none;">{{$group->id}}</div>
                                        </td>
                                        <td>
                                            <div class="row form-group">
                                                <a onclick="add_menu_video('{{$group->id}}')" data-toggle="tooltip"
                                                   style="cursor: pointer"
                                                   title="Chỉnh
                                                sửa" class="col-sm-6
                                                text-primary"><i class="fa fa-wrench"></i></a>
                                                <a data-toggle="tooltip" title="Xóa"
                                                   href="{{route('delete_menu',$group->id)}}" onclick="return confirm('Bạn chắc chắn muốn xóa')" class="col-sm-6 text-danger" @if($group->status != 0) style="display: none;" @endif><i
                                                            class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row form-group pull-right" style="margin: 10px 0px">
                                {!! $list_group->links('vendor.pagination.bootstrap-4') !!}
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
    <div class="modal fade" id="form_menu_video" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">

    </div>
@stop

@section('css')
@stop


@section('script')
<script type="text/javascript" src="js/group_video.js"></script>
@stop