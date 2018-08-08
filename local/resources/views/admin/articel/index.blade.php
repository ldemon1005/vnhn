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
                                {{--{{dd($paramater)}}--}}
                                <form action="{{ url('/admin/articel') }}" method="get">
                                    <div class="row form-group">
                                        <div class="col-md-4">
                                            <input value="{{isset($paramater['key_search']) ? $paramater['key_search'] : ''}}" class="form-control" name="articel[key_search]" placeholder="Từ khóa tìm kiếm">
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-control select2" multiple="multiple"
                                                    data-placeholder="Lọc theo danh mục" name="articel[group_id][]"
                                                    style="width: 100%;">
                                                @foreach($list_group as $group_item)
                                                    <option {{isset($paramater['group_id']) && count($paramater['group_id']) ? in_array($group_item->id,$paramater['group_id']) ? 'selected' : '' : ''}} value="{{ $group_item->id }}">{{ $group_item->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <select class="form-control select2" multiple="multiple"
                                                    data-placeholder="Lọc theo trạng thái" name="articel[status][]"
                                                    style="width: 100%;">
                                                <option {{isset($paramater['status']) && count($paramater['status']) ? in_array(1,$paramater['status']) ? 'selected' : '' : ''}} value="1">Mới</option>
                                                <option {{isset($paramater['status']) && count($paramater['status']) ? in_array(2,$paramater['status']) ? 'selected' : '' : ''}} value="2">Chưa duyệt</option>
                                                <option {{isset($paramater['status']) && count($paramater['status']) ? in_array(3,$paramater['status']) ? 'selected' : '' : ''}} value="3">Đã duyệt</option>
                                                <option {{isset($paramater['status']) && count($paramater['status']) ? in_array(4,$paramater['status']) ? 'selected' : '' : ''}} value="4">Đã hủy</option>
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
                                    <th class="titleTable">Tiêu đề bài viết</th>
                                    <th>Tác giả</th>
                                    <th>Chuyên mục</th>
                                    <th class="hideResponsive768">Ngày tạo--Ngày update</th>
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
                                        <td class="hideResponsive768">
                                            {{$articel->created_at}}--{{$articel->updated_at}}
                                        </td>
                                        <td>
                                            <div class="avatar">
                                                {{-- <img src="{{ file_exists(resource_path($articel->fimage)) ? asset('/local/resources'.$articel->fimage) : (file_exists('http://vietnamhoinhap.vn/'.$articel->fimage) ? 'http://vietnamhoinhap.vn/'.$articel->fimage : '../images/default-image.png' )}}"> --}}

                                                <img src="{{ isset($articel->fimage)  && $articel->fimage ? (file_exists(storage_path('app/article/resized200-'.$articel->fimage)) ? asset('local/storage/app/article/resized200-'.$articel->fimage) : (file_exists(resource_path($articel->fimage)) ? asset('/local/resources'.$articel->fimage) : '../images/default-image.png')) : '../images/default-image.png' }}">
                                                
                                            </div>
                                        </td>
                                        <td>
                                            @if (Auth::user()->level > 2)
                                                <button class="btn btn-block btn-sm {{ $articel->status != 1 ? 'btn-danger ' : 'btn-success ' }}">{{ $articel->status == 1? ' Hoạt động' : 'Không hoạt động' }}</button>
                                            @else 
                                                <button class="btn btn-block btn-sm {{ $articel->status != 1 ? 'btn-danger' : 'btn-success' }} {{ $articel->status == 0 ? 'btnOn' : ($articel->status == 1 ? 'btnOff' : '' )}}">{{ $articel->status == 1? ' Hoạt động' : 'Không hoạt động' }}</button>
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
                                                            @if(isset($articel->username) && $articel->username->level == 3)

                                                            <button class="btn btn-block btn-sm btn-info btn3">Trả lại</button>
                                                            @else
                                                            <button class="btn btn-block btn-sm btn-info btn4">Trả lại</button>
                                                            @endif
                                                            @break

                                                        @default
                                                            <button class="btn btn-block btn-sm btn-danger">Lỗi</button>
                                                            @break
                                                    @endswitch
                                                    @break
                                                @case(3)
                                                    @switch($articel->status)
                                                        @case(0)
                                                            <button class="btn btn-block btn-sm btn-default">Dừng</button>
                                                            @break
                                                        @case(2)
                                                            <button class="btn btn-block btn-sm btn-default">Đã gửi</button>
                                                            @break
                                                        @case(3)
                                                            @if(Auth::user()->id == $articel->userid)
                                                                <button class="btn btn-block btn-sm btn-success btn2">Gửi lại</button>
                                                            @else
                                                                <button class="btn btn-block btn-sm btn-success btn2">Duyệt</button>
                                                                <button class="btn btn-block btn-sm btn-info btn4">Trả lại</button>
                                                            @endif
                                                                
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
                                            
                                            
                                            <div class="id_group" style="display: none;">{{$articel->id}}</div>
                                           
                                        </td>
                                        <td>
                                            <div class="row form-group">
                                                <a href="{{route('form_articel',$articel->id)}}" data-toggle="tooltip" title="Chỉnh sửa" class="col-sm-4 text-primary"><i class="fa fa-wrench"></i></a>

                                                    
                                                <a data-toggle="tooltip" title="Xóa" href="{{route('delete_articel',$articel->id)}}" class="col-sm-4 text-danger btnDelete" @if ($articel->status == 1) style="display: none" @endif  onclick="return confirm('Bạn chắc chắn muốn xóa')"><i
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