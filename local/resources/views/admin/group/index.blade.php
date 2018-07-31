@extends('admin.master')
@section('title', 'Quản trị')
@section('main')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 ">Danh sách Danh mục</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Danh sách danh mục</li>
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
                                <div class="col-md-4">
                                    <a href="{{route('form_group',0)}}" class="btn btn-primary"><h3 class="card-title">Thêm mới danh mục</h3></a>
                                </div>
                                <div class="col-md-6">
                                    <form action="{{route('admin_group')}}" method="get">
                                        <div class="row form-group">
                                            <div class="col-md-9">
                                                <select class="select2" data-placeholder="Chọn danh mục"
                                                        name="groupid"
                                                        style="width: 100%;">
                                                    <option value="null">Chọn danh mục</option>
                                                    @foreach($groups as $articel_item)
                                                        <option {{$parentid == $articel_item->id ? 'selected' : ''}}
                                                                value="{{
                                                        $articel_item->id }}">{{
                                                        $articel_item->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-3">
                                                <button style="height: 90%" type="submit" class="btn btn-primary">Tìm kiếm</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Tên danh mục</th>
                                    <th>Mô tả danh mục</th>
                                    <th>Đường dẫn</th>
                                    <th>Ngày tạo</th>
                                    <th>Avatar</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($list_group as $group)
                                    <tr>
                                        <td>{{$group->title}}</td>
                                        <td>{{$group->summary}}</td>
                                        <td>{{$group->slug}}</td>
                                        <td>{{$group->created_at}}</td>
                                        <td><img style="height: 50px" src="{{asset('/local/resources'.$group->avatar)}}"></td>
                                        <td>
                                            <button class="btn btn-block btn-sm {{ $group->status == 2 ? 'btn-danger' : 'btn-success' }}">{{ $group->status ? 'Không hoạt động' : 'Hoạt động' }}</button>
                                        </td>
                                        <td>
                                            <div class="row form-group">
                                                <a href="{{route('form_group',$group->id)}}" data-toggle="tooltip" title="Chỉnh sửa" class="col-sm-6 text-primary"><i class="fa fa-wrench"></i></a>
                                                <a data-toggle="tooltip" title="Xóa" href="{{route('delete_group',$group->id)}}" class="col-sm-6 text-danger"><i
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
@stop

@section('css')
@stop


@section('script')
@stop