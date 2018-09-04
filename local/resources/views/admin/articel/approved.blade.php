@extends('admin.master')
@section('title', 'Phê duyệt')
@section('main')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 ">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Phê duyệt Bài viết' : 'Approve article '}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ asset('admin') }}">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Trang chủ' : 'Home '}}</a></li>
                            <li class="breadcrumb-item active">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Phê duyệt Bài viết' : 'Approve article '}}</li>
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

                        {{-- <div class="card-header">
                            <a href="{{route('form_articel',0)}}" class="btn btn-primary"><h3 class="card-title">Thêm mới Bài viết</h3></a>
                        </div> --}}
                        <!-- /.card-header -->
                        <div class="card-body">
                                {{--{{dd($paramater)}}--}}
                                <form action="{{ Request::segment(3) == 'approved' ? url('/admin/articel/approved') : url('/admin/articel') }}" method="get">
                                    <div class="row form-group">
                                        <div class="col-md-3">
                                            <input value="{{isset($paramater['key_search']) ? $paramater['key_search'] : ''}}" class="form-control" name="articel[key_search]" placeholder="Từ khóa tìm kiếm">
                                        </div>
                                        <div class="col-md-2">
                                            <select class="form-control select2" multiple="multiple"
                                                    data-placeholder="Lọc theo danh mục" name="articel[group_id][]"
                                                    style="width: 100%;">
                                                @foreach($list_group as $group_item)
                                                    <option {{isset($paramater['group_id']) && count($paramater['group_id']) ? in_array($group_item->id,$paramater['group_id']) ? 'selected' : '' : ''}} value="{{ $group_item->id }}">{{ $group_item->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if(Auth::user()->level < 2 )
                                        <div class="col-md-2">
                                            <select class="form-control select2" multiple="multiple"
                                                    data-placeholder="Lọc theo trạng thái" name="articel[status][]"
                                                    style="width: 100%;">
                                                <option {{isset($paramater['status']) && count($paramater['status']) ? in_array(0,$paramater['status']) ? 'selected' : '' : ''}} value="0">Dừng</option>
                                                <option {{isset($paramater['status']) && count($paramater['status']) ? in_array(1,$paramater['status']) ? 'selected' : '' : ''}} value="1">Đang chạy</option>
                                                <option {{isset($paramater['status']) && count($paramater['status']) ? in_array(2,$paramater['status']) ? 'selected' : '' : ''}} value="2">Chờ duyệt lần 2</option>
                                                <option {{isset($paramater['status']) && count($paramater['status']) ? in_array(3,$paramater['status']) ? 'selected' : '' : ''}} value="3">Chờ duyệt lần 1</option>
                                                <option {{isset($paramater['status']) && count($paramater['status']) ? in_array(4,$paramater['status']) ? 'selected' : '' : ''}} value="4">Trả lại</option>
                                            </select>
                                        </div>
                                        @endif
                                        @if (Auth::user()->site == 1)
                                        <div class="col-md-2">
                                            <select class="form-control select2" multiple="multiple"
                                                    data-placeholder="Lọc theo lần gửi" name="articel[return_num][]"
                                                    style="width: 100%;">
                                                <option {{isset($paramater['return_num']) && count($paramater['return_num']) ? in_array(0,$paramater['return_num']) ? 'selected' : '' : ''}} value="0">Bài mới gửi</option>
                                                <option {{isset($paramater['return_num']) && count($paramater['return_num']) ? in_array(1,$paramater['return_num']) ? 'selected' : '' : ''}} value="1">Bài gửi lại</option>
                                            </select>
                                        </div>  
                                        @endif
                                        @if(Auth::user()->site == 1 && Auth::user()->level < 3)
                                        <div class="col-md-2">
                                            <select class="form-control select2" multiple="multiple"
                                                    data-placeholder="Lọc theo công ty" name="articel[site][]"
                                                    style="width: 100%;">
                                                <option {{isset($paramater['site']) && count($paramater['site']) ? in_array(1,$paramater['site']) ? 'selected' : '' : ''}} value="1">Cgroup</option>
                                                <option {{isset($paramater['site']) && count($paramater['site']) ? in_array(2,$paramater['site']) ? 'selected' : '' : ''}} value="2">VNHN</option>
                                            </select>
                                        </div>
                                        @endif
                                        <div class="col float-right">
                                            <button class="btn btn-primary float-right" type="submit"><i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                     <th>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Thời gian' : 'Post time'}}</th>
                                    <th>Hình ảnh</th>
                                    <th class="titleTable">Tiêu đề bài viết</th>
                                    <th>Chuyên mục</th>
                                    <th>Người tạo</th>
                                    <th class="nowrap">Người duyệt</th>
                                    
                                    
                                    <th style="min-width: 50px">Duyệt bài</th>
                                    <th>Thao tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($list_articel as $articel)
                                    @if(Auth::user()->id != $articel->userid)
                                    <tr>
                                        <td>
                                            <div class="articleTime">
                                                <div class="articleTimeShow">
                                                    <div class="articleTimeShowDay">
                                                        {{$articel->release_time->day}}
                                                    </div>
                                                    <div class="articleTimeShowH">
                                                        {{$articel->release_time->h}}
                                                    </div>
                                                     
                                                </div>
                                                <div class="articleTimeBtnEdit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </div>
                                                <div class="articleTimeHide">
                                                    <div>
                                                        <input type="date" name="articel[release_time][day]" required
                                                           value="{{$articel->release_time->day}}" min="1000-01-01"
                                                           max="3000-12-31" class="form-control" style="font-size: 12px;">
                                                    </div>
                                                    
                                                    <div class="input-group">
                                                        <input type="text" name="articel[release_time][h]"
                                                               value="{{$articel->release_time->h}}" class="form-control timepicker">

                                                        <div class="input-group-append btn_send_time">
                                                            <span class="input-group-text bg-danger">
                                                                <i class="far fa-check-circle"></i>
                                                            </span>
                                                        </div>
                                                        <div class="id_group" style="display: none;">{{$articel->id}}</div>
                                                    </div>
                                                    <!-- /.form group -->
                                                </div>
                                            </div>

                                                    
                                        </td>
                                        <td>
                                            <div class="avatar">
                                                <img src="{{ isset($articel->fimage)  && $articel->fimage ? (file_exists(storage_path('app/article/resized200-'.$articel->fimage)) ? asset('local/storage/app/article/resized200-'.$articel->fimage) : (file_exists(resource_path($articel->fimage)) ? asset('/local/resources'.$articel->fimage) : '../images/default-image.png')) : '../images/default-image.png' }}">
                                            </div>
                                        </td>
                                        <td class="a_hover">
                                            <a  style="cursor: pointer;"  onclick="view_articel_now('{{route('view_log_now',$articel->id)}}')" >
                                                 {{$articel->title}}
                                            </a>
                                        </td>
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
                                            @if(isset($articel->author))
                                                <div class="">{{ $articel->author  }} </div>
                                                <div class="timeTiny">{{ $articel->author_date  }} </div>

                                            @else
                                                Không còn
                                            @endif
                                            
                                        </td>
                                        <td>
                                            @if(isset($articel->approved))
                                                <div class="">{{ $articel->approved  }} </div>
                                                <div class="timeTiny">{{ $articel->approved_date  }} </div>

                                            @else
                                                @if(isset($articel->author))
                                                    <div class="">{{ $articel->author  }} </div>
                                                    <div class="timeTiny">{{ $articel->author_date  }} </div>

                                                @else
                                                    Không còn
                                                @endif
                                            @endif
                                            
                                        </td>
                                        <td>
                                            @switch(Auth::user()->level)
                                                @case(1)
                                                     @switch($articel->status)
                                                        @case(0){{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Đang chạy' : 'Running'}}
                                                            <button class="btn btn-block btn-sm btn-default btnDeni">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Dừng' : 'Stop'}}</button>
                                                            @break
                                                        @case(1)
                                                            <button class="btn btn-block btn-sm btn-default btnRun">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Đang chạy' : 'Running'}}</button>
                                                            @break
                                                        @case(2)
                                                            <button class="btn btn-block btn-sm btn-success btn1">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Chờ duyệt lần 2' : 'Wait for approval(2)'}}</button>
                                                            @break
                                                        @case(3)
                                                            <button class="btn btn-block btn-sm btn-success btn2">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Chờ duyệt lần 1' : 'Wait for approval(1)'}}</button>
                                                            @break
                                                        @case(4)
                                                            <button class="btn btn-block btn-sm btn-success btn3">Gửi lại</button>
                                                            @break
                                                        @default
                                                            <button class="btn btn-block btn-sm btn-danger">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Lỗi' : 'Error'}}</button>
                                                            @break
                                                    @endswitch
                                                    @break
                                                @case(2) 
                                                    @switch($articel->status)
                                                        @case(0)
                                                            <button class="btn btn-block btn-sm btn-default btnDeni">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Dừng' : 'Stop'}}</button>
                                                            @break
                                                        @case(1)
                                                            <button class="btn btn-block btn-sm btn-default btnRun">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Đang chạy' : 'Running'}}</button>
                                                            @break
                                                        @case(2)

                                                            <button class="btn btn-block btn-sm btn-success btn1">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Duyệt' : 'Approval'}}</button>
                                                            @if(isset($articel->username) && $articel->username->level == 3)
                                                                @if (Auth::check() && Auth::user()->site == 1)
                                                                    <button class="btn btn-block btn-sm btn-info btn_return">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Trả lại('.$articel->return_num.')' : 'Returned'}}</button>
                                                                @else
                                                                    <button class="btn btn-block btn-sm btn-info btn_return">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Trả lại' : 'Returned'}}</button>
                                                                @endif
                                                                    
                                                            @else
                                                                @if (Auth::check() && Auth::user()->site == 1)
                                                                    <button class="btn btn-block btn-sm btn-info btn_return">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Trả lại('.$articel->return_num.')' : 'Returned'}}</button>
                                                                @else
                                                                    <button class="btn btn-block btn-sm btn-info btn_return">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Trả lại' : 'Returned'}}</button>
                                                                @endif
                                                            @endif
                                                            @break

                                                        @default
                                                            <button class="btn btn-block btn-sm btn-danger">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Lỗi' : 'Error'}}</button>
                                                            @break
                                                    @endswitch
                                                    @break
                                                @case(3)
                                                    @switch($articel->status)
                                                        @case(0)
                                                            <button class="btn btn-block btn-sm btn-default btnDeni">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Dừng' : 'Stop'}}</button>
                                                            @break
                                                        @case(2)
                                                            <button class="btn btn-block btn-sm btn-default">Đã gửi</button>
                                                            @break
                                                        @case(3)
                                                            @if(Auth::user()->id == $articel->userid)
                                                                <button class="btn btn-block btn-sm btn-success btnComment">Lý do</button>
                                                            @else
                                                                <button class="btn btn-block btn-sm btn-success btn2">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Duyệt' : 'Approval'}}</button>
                                                                @if (Auth::user()->site == 1 )
                                                                    <button class="btn btn-block btn-sm btn-info btn_return">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Trả lại('.$articel->return_num.')' : 'Returned'}}</button>
                                                                @else
                                                                    <button class="btn btn-block btn-sm btn-info btn_return">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Trả lại' : 'Returned'}}</button>
                                                                @endif
                                                                
                                                            @endif
                                                                
                                                            @break

                                                        @default
                                                            <button class="btn btn-block btn-sm btn-default">Không</button>
                                                            @break
                                                    @endswitch
                                                    @break
                                                 @case(4)
                                                    @switch($articel->status)
                                                        @case(3)
                                                            <button class="btn btn-block btn-sm btn-default">Đã gửi</button>
                                                            @break
                                                        @case(4)
                                                            <button class="btn btn-block btn-sm btn-success btnComment">Lý do</button>
                                                            @break
                                                        @default
                                                            <button class="btn btn-block btn-sm btn-default">Không</button>
                                                            @break
                                                    @endswitch
                                                    @break
                                                @default
                                                    <button class="btn btn-block btn-sm btn-danger">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Lỗi' : 'Error'}}</button>
                                                    @break
                                            @endswitch
                                            
                                            <div class="id_group" style="display: none;">{{$articel->id}}</div>
                                        </td>
                                        <td>
                                            <div class="row form-group">
                                                @if($articel->status != 1 || Auth::user()->level < 3)
                                                    <a href="{{route('form_articel',$articel->id)}}" data-toggle="tooltip" title="Chỉnh sửa" class="col-sm-4 text-primary"><i class="fa fa-wrench"></i></a>
                                                @endif
                                                @if (Auth::user()->site == 1 || Request::segment(3) != 'approved_cgroup')
                                                    <a data-toggle="tooltip" title="Xóa" href="{{route('delete_articel',$articel->id)}}" class="col-sm-4 text-danger btnDelete" @if ($articel->status == 1) style="display: none" @endif  onclick="return confirm('Bạn chắc chắn muốn xóa')"><i
                                                            class="fa fa-trash"></i></a>
                                                @endif
                                                
                                                <a style="cursor: pointer" onclick="historyArticel({{$articel->id}})"   title="Lịch sử" class="col-sm-4 text-dark"><i class="fa fa-book"></i></a>
                                                
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
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
    <div class="modal fade" id="comment_article" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Chú thích trả lại</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ asset('admin/articel/return') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="id_article" value="">
                            <textarea class="form-control" name="messages" placeholder="Chú thích cho bài trả về" rows="5"></textarea>
                            <input type="submit" name="btn_sbm_return" class="btn btn-block btn-sm btn-success float-right d-none" > 
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-primary btn_sbm_return_remote">Trả lại</button>
                    </div>
                </div>
            </div>
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
    <script>
        function view_articel_now(url) {
            newwindow=window.open(url,'VietNamHoiNhap','height=500,width=800,top=150,left=200, location=0');
            if (window.focus) {newwindow.focus()}
            return false;
        }
    </script>
@stop