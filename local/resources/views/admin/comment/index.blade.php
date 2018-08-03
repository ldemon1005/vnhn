@extends('admin.master')
@section('title', 'Comment')
@section('main')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 ">Danh sách Comment</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ asset('admin') }}">Home</a></li>
                            <li class="breadcrumb-item active">Danh sách comment</li>
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
                        <!-- /.card-header -->
                        <div class="card-body">

                                <form action="{{ url('/admin/comment') }}" method="get">
                                    <div class="row form-group">
                                        <div class="col-md-3">
                                            <select class="form-control select2"
                                                    data-placeholder="Lọc theo trạng thái" name="comment[status][]"
                                                    style="width: 100%;">
                                                <option value="3">Trạng thái</option>
                                                <option value="0">Chưa duyệt</option>
                                                <option value="1">Đã duyệt</option>
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
                                    <th>Tên bài viết</th>
                                    <th>Đường dẫn</th>
                                    <th>Ngày gửi</th>
                                    <th>Email gửi</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{--{{dd($list_comment)}}--}}
                                @foreach($list_comment as $comment)
                                    <tr>
                                        <td>{{$comment->news->title}}</td>
                                        <td>
                                            <a href="{{ route('get_detail_articel',$comment->news->slug.'---n-'.$comment->news->id) }}" target="_blank">{{$comment->news->slug}}</a>
                                        </td>
                                        <td>
                                            {{$comment->created_at}}
                                        </td>
                                        <td>{{$comment->email}}</td>
                                        <td>
                                            <button id="cm-status" class="btn btn-block btn-sm {{ $comment->status == 0 ? 'btn-danger' : 'btn-success' }} btn_status" >{{ $comment->status == 0 ? 'Chưa duyệt' : 'Đã duyệt' }}</button>
                                            <div class="comment_id" style="display: none;">{{$comment->id}}</div>
                                        </td>
                                        <td>
                                            <div class="row form-group">
                                                <a data-toggle="tooltip" title="Xóa" href="{{route('delete_articel',$comment->id)}}" class="col-sm-4 text-danger" @if ($comment->status == 1) style="display: none;" @endif><i
                                                            class="fa fa-trash"></i></a>
                                                <a style="cursor: pointer" onclick="open_comment('{{$comment->content}}')" title="Xem bình luận" class="col-sm-4 text-dark"><i class="far fa-eye"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row form-group pull-right" style="margin: 10px 0px">
                                {!! $list_comment->links('vendor.pagination.bootstrap-4') !!}
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>

    <div class="modal fade" id="show_comment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bình luận</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script type="text/javascript" src="js/comment.js"></script>
@stop