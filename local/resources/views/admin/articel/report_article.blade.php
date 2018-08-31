@extends('admin.master')
@section('title', 'Quản trị')
@section('main')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 ">Báo cáo thống kê bài viết</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ asset('admin') }}">Home</a></li>
                            <li class="breadcrumb-item active">Báo cáo thống kê bài viết</li>
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
                                {{--{{dd($paramater)}}--}}
                                <form action="{{ route('report_article') }}" method="get">
                                    <div class="row form-group">
                                        <div class="col-md-4">
                                            <input value="{{$key}}" name="key" class="form-control" placeholder="nhập từ khóa">
                                        </div>
                                        <div class="col-md-6 input-group">
                                            <div class="d-flex flex-row align-items-center">
                                                <div><b>Thời gian thống kê: {{$from}} <span class="text-warning">đến</span> {{$to}}</b></div>
                                                <div class="ml-3">
                                                    <button type="button" class="btn btn-default pull-right"
                                                            id="daterange-btn"><span><i class="fa fa-calendar"></i></span>
                                                    </button>
                                                    <input id="from" name="from" class="d-none">
                                                    <input id="to" name="to" class="d-none">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col pull-right ">
                                            
                                            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i>
                                            </button>
                                            <div class="btn btn-default btn_print">
                                                <i class="fas fa-print"></i>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                </form>
                            <table id="table_report" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Tài khoản</th>
                                    <th>Họ và tên</th>
                                    <th>Tổng bài</th>
                                    <th>Bài tổng hợp</th>
                                    <th>Bài tự viết</th>
                                    <th>Bài biên tập</th>
                                    <th>Bài copy</th>
                                    <th>Chưa đăng</th>
                                    {{--<th>Đối tác</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($list_user as $user)
                                    <tr>
                                        <td> 
                                            <a href="{{route('detail_report_article',$user->id)}}">
                                                <div class="avatarImg50 report" style="background: url('{{ file_exists(storage_path('app/avatar/'.$user->img)) && $user->img ? asset('local/storage/app/avatar/resized-'.$user->img) : '../images/images.png' }}') no-repeat center /cover;">
                                                </div>
                                                {{$user->username}}
                                                <div class="timeTiny">{{$user->email}}</div>
                                            </a>
                                        </td>
                                        <td>{{$user->fullname}}</td>
                                        <td>{{$user->total}}</td>
                                        <td>{{$user->tong_hop}}</td>
                                        <td>{{$user->tu_viet}}</td>
                                        <td>{{$user->bien_tap}}</td>
                                        <td>{{$user->copy}}</td>
                                        <td>{{$user->chua_dang}}</td>
                                        {{--<td>{{$user->site == 1 ? "CGROUP" : "VNHN"}}</td>--}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row form-group pull-right" style="margin: 10px 0px">
                                {{--{!! $list_user->links('vendor.pagination.bootstrap-4') !!}--}}
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
@stop

@section('script')
    <!-- Select2 -->
    <script>
        console.log('chào',moment());
        $('#daterange-btn').daterangepicker(
            {
                opens: "right",
                /*autoApply: true,*/
                locale: {
                    "format": "DD/MM/YYYY",
                    "separator": " - ",
                    "applyLabel": "Chọn",
                    "cancelLabel": "Hủy",
                    "fromLabel": "Từ",
                    "toLabel": "Đến",
                    "customRangeLabel": "Tùy chọn",
                    "weekLabel": "W",
                    "daysOfWeek": [
                        "CN",
                        "T2",
                        "T3",
                        "T4",
                        "T5",
                        "T6",
                        "T7"
                    ],
                    "monthNames": [
                        "Tháng 1",
                        "Tháng 2",
                        "Tháng 3",
                        "Tháng 4",
                        "Tháng 5",
                        "Tháng 6",
                        "Tháng 7",
                        "Tháng 8",
                        "Tháng 9",
                        "Tháng 10",
                        "Tháng 11",
                        "Tháng 12"
                    ],
                    "firstDay": 1
                },
                ranges   : {
                    'Hôm nay'       : [moment(), moment()],
                    'Hôm qua'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '7 ngày trước' : [moment().subtract(6, 'days'), moment()],
                    '30 ngày trước': [moment().subtract(29, 'days'), moment()],
                    'Tháng này'  : [moment().startOf('month'), moment().endOf('month')],
                    'Tháng trước'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment('{{$from}}','DD-MM-YYYY').startOf('day'),
                endDate  : moment('{{$to}}','DD-MM-YYYY').endOf('day')
            },
            function (start, end) {
                $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
        );
        $('#daterange-btn').on('apply.daterangepicker', function(ev, picker) {
            $('#from').val(picker.startDate.format('YYYY-MM-DD'));
            $('#to').val(picker.endDate.format('YYYY-MM-DD'));
            $('#filter_form').submit();
        });

    </script>
   {{--  <script type="text/javascript" src="js/article.js"></script> --}}
    <script type="text/javascript">
        $(document).ready(function(){
            $('.btn_print').click(function(){
                // alert('ok');
                window.print();
            });
        });
    </script>

@stop