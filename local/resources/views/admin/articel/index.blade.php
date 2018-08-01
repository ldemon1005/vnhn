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
                            <li class="breadcrumb-item"><a href="{{ asset('admin') }}">Home</a></li>
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
                                    <th>Tiêu đề bài viết</th>
                                    <th>Tác giả</th>
                                    <th>Chuyên mục</th>
                                    <th>Ngày tạo--Ngày update</th>
                                    <th>Avatar</th>
                                    <th>Trạng thái</th>
                                    <th style="min-width: 50px">Duyệt bài</th>
                                    <th>Thao tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($list_articel as $articel)
                                    <tr>
                                        <td>{{$articel->title}}</td>
                                        <td>{{isset($articel->username)? $articel->username->username : 'Không còn'}}</td>
                                        <td>
                                            <?php $count = 0?>
                                            @foreach($list_group as $articel_item)
                                                @if (in_array($articel_item->id,explode(' ',$articel->groupid)))
                                                    <button class="btn btn-outline-default btn-sm">
                                                        {{ $articel_item->title }}
                                                    </button>
                                                    <?php $count++?>
                                                @endif
                                            @endforeach
                                            @if ($count == 0)
                                                <button class="btn btn-outline-default btn-sm">
                                                    Lỗi
                                                </button>
                                            @endif
                                            
                                        </td>
                                        <td>
                                            {{$articel->created_at}}--{{$articel->updated_at}}
                                        </td>
                                        <td>
                                            <div class="avatar">
                                                <img src="{{ file_exists(resource_path($articel->fimage)) ? asset('/local/resources'.$articel->fimage) : 'http://vietnamhoinhap.vn/'.$articel->fimage }}">
                                            </div>
                                        </td>
                                        <td>
                                            @if (Auth::user()->level > 2)
                                                <button class="btn btn-block btn-sm {{ $articel->status != 1 ? 'btn-danger ' : 'btn-success ' }}">{{ $articel->status == 1? ' Hoạt động' : 'Không hoạt động' }}</button>
                                            @else 
                                                <button class="btn btn-block btn-sm {{ $articel->status != 1 ? 'btn-danger btnOn' : 'btn-success btnOff' }}">{{ $articel->status == 1? ' Hoạt động' : 'Không hoạt động' }}</button>
                                            @endif
                                            
                                            <div class="id_group" style="display: none;">{{$articel->id}}</div>
                                        </td>
                                        <td>
                                            @switch(Auth::user()->level)
                                                @case(1)
                                                     @switch($articel->status)
                                                        @case(0)
                                                            <button class="btn btn-block btn-sm btn-default btnDeni">Dừng</button>
                                                            @break
                                                        @case(1)
                                                            <button class="btn btn-block btn-sm btn-default btnRun">Đang chạy</button>
                                                            @break
                                                        @case(2)
                                                            <button class="btn btn-block btn-sm btn-success btn1">Chờ duyệt lần 2</button>
                                                            @break
                                                        @case(3)
                                                            <button class="btn btn-block btn-sm btn-success btn2">Chờ duyệt lần 1</button>
                                                            @break
                                                        @case(4)
                                                            <button class="btn btn-block btn-sm btn-success btn3">Gửi lại</button>
                                                            @break
                                                        @default
                                                            <button class="btn btn-block btn-sm btn-danger">Lỗi</button>
                                                            @break
                                                    @endswitch
                                                    @break
                                                @case(2) 
                                                    @switch($articel->status)
                                                        @case(0)
                                                            <button class="btn btn-block btn-sm btn-default">Dừng</button>
                                                            @break
                                                        @case(1)
                                                            <button class="btn btn-block btn-sm btn-default">Đang chạy</button>
                                                            @break
                                                        @case(2)
                                                            <button class="btn btn-block btn-sm btn-success btn1">Duyệt</button>
                                                            <button class="btn btn-block btn-sm btn-info btn4">Trả lại</button>
                                                            @break

                                                        @default
                                                            <button class="btn btn-block btn-sm btn-danger">Lỗi</button>
                                                            @break
                                                    @endswitch
                                                    @break
                                                @case(3)
                                                    @switch($articel->status)
                                                        @case(2)
                                                            <button class="btn btn-block btn-sm btn-default">Đã gửi</button>
                                                            @break
                                                        @case(3)
                                                            <button class="btn btn-block btn-sm btn-success btn2">Duyệt</button>
                                                            <button class="btn btn-block btn-sm btn-info btn4">Trả lại</button>
                                                            @break
                                                        @default
                                                            <button class="btn btn-block btn-sm btn-danger">Lỗi</button>
                                                            @break
                                                    @endswitch
                                                    @break
                                                 @case(4)
                                                    @switch($articel->status)
                                                        @case(3)
                                                            <button class="btn btn-block btn-sm btn-default">Đã gửi</button>
                                                            @break
                                                        @case(4)
                                                            <button class="btn btn-block btn-sm btn-success btn3">Gửi lại</button>
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
                                            
                                            {{-- @switch($articel->status)
                                                @case(0)
                                                    <button class="btn btn-block btn-sm btn-default btnDeni">Dừng</button>
                                                    @break
                                                @case(1)
                                                    <button class="btn btn-block btn-sm btn-default btnRun">Đang chạy</button>
                                                    @break
                                                @case(2)
                                                    <button class="btn btn-block btn-sm btn-success btn1">Duyệt</button>
                                                    @break
                                                @case(3)
                                                    <button class="btn btn-block btn-sm btn-success btn2">Duyệt</button>
                                                    @break
                                                @case(4)
                                                    <button class="btn btn-block btn-sm btn-success btn3">Gửi lại</button>
                                                    @break
                                                @default
                                                    <button class="btn btn-block btn-sm btn-danger">Lỗi</button>
                                                    @break
                                            @endswitch --}}
                                            <div class="id_group" style="display: none;">{{$articel->id}}</div>
                                           {{--  <select style="width: 100%" class="form-control"
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
                                            </select> --}}
                                        </td>
                                        <td>
                                            <div class="row form-group">
                                                <a href="{{route('form_articel',$articel->id)}}" data-toggle="tooltip" title="Chỉnh sửa" class="col-sm-4 text-primary"><i class="fa fa-wrench"></i></a>

                                                    
                                                <a data-toggle="tooltip" title="Xóa" href="{{route('delete_articel',$articel->id)}}" class="col-sm-4 text-danger btnDelete" @if ($articel->status != 0 && $articel->status != 4 ) style="display: none" @endif ><i
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
    <script type="text/javascript" src="js/article.js"></script>
@stop