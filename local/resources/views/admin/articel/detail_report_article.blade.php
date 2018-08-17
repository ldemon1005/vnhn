@extends('admin.master')
@section('title', 'Thống kê')
@section('main')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="">
                    <div class="small">
                        <a href="{{route('report_article')}}" title="Trở lại">
                            <i class="fa fa-hand-point-left"></i>
                            <span>Báo cáo thống kê bài viết</span>
                        </a>
                    </div>
                    <h1 class="my-2">Báo cáo thống kê bài viết {{$user->fullname ? $user->fullname : ''}}</h1>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content" id="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                                {{--{{dd($paramater)}}--}}
                                <form action="{{ route('detail_report_article',$user->id) }}" method="get" id="search">
                                    <div class="d-flex flex-row align-items-center">
                                        <div><b>Thời gian thống kê: {{$from}} <span class="text-warning">đến</span> {{$to}}</b></div>
                                        <div class="ml-3">
                                            <button type="button" class="btn btn-default pull-right"
                                                    id="daterange-btn"><span><i class="fa fa-calendar"></i></span>
                                            </button>
                                            <input id="from" name="from" class="d-none">
                                            <input id="to" name="to" class="d-none">
                                        </div>
                                        <div class="btn btn-default ml-4" onclick="print()">
                                            <i class="fas fa-print"></i>
                                        </div>
                                        
                                    </div>
                                </form>
                                
                            <div style="margin:20px 0">
                                <div class="row" style="margin-bottom: 20px; ">
                                    <div class="col-md-4">
                                        <div class="bg-primary text-white total">
                                            <div class="text-small">Tổng số</div>
                                            <div class="number"> {{$user->total}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="bg-success text-white total">
                                            <div class="text-small"> Bài đã đăng</div>
                                            <div class="number">  {{$user->da_dang}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="bg-secondary text-white total">
                                            <div class="text-small">Bài chưa đăng</div>
                                            <div class="number">  {{$user->chua_dang}}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="bg-warning text-white total">
                                            <div class="text-small">Tổng hợp</div>
                                            <div class="number"> {{$user->tong_hop}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="bg-danger text-white total">
                                            <div class="text-small">Tự viết</div>
                                            <div class="number">  {{$user->tu_viet}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="bg-info text-white total">
                                            <div class="text-small">Biên tập</div>
                                            <div class="number">  {{$user->bien_tap}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="bg-black text-white total">
                                            <div class="text-small">Copy</div>
                                            <div class="number">  {{$user->copy}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <h4>Danh sách bài viết</h4>
                            <table id="table_report" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Tiêu đề bài viết</th>
                                    <th>Ngày viết bài</th>
                                    <th>Bài tổng hợp</th>
                                    <th>Bài tự viết</th>
                                    <th>Bài biên tập</th>
                                    <th>Bài copy</th>

                                    <th>Chưa đăng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($list_article as $article)
                                    <tr>
                                        <td class="a_hover">
                                            {{-- @if($article->status == 1)
                                                <a href="{{ route('get_detail_articel',$article->slug.'---n-'.$article->id) }}">{{$article->title}}</a>
                                            @else
                                                {{$article->title}}
                                            @endif --}}
                                            <a  style="cursor: pointer;"  onclick="view_articel_now('{{route('view_log_now',$article->id)}}')" >
                                                 {{$article->title}}
                                            </a>
                                        </td>
                                        <td>{{date('d/m/Y H:m',$article->created_at)}}</td>
                                        <td class="text-center">
                                            @if($article->loaitinbai == 1 && $article->status == 1)
                                                <span class="text-success">x</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($article->loaitinbai == 2 && $article->status == 1)
                                                <span class="text-success">x</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($article->loaitinbai == 3 && $article->status == 1)
                                                <span class="text-success">x</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($article->loaitinbai == 4 && $article->status == 1)
                                                <span class="text-success">x</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($article->status != 1)
                                                <span class="text-success">x</span>
                                            @endif
                                        </td>
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
    <style>
        .total {
            padding: 8px 15px;
            border-radius: 3px;
            display: flex;
            align-items:  center;
            justify-content: space-between;
        }
        .text-small {
            text-transform: uppercase;
            font-size: 85%;
            font-weight: 700;
        }
        .number {
            font-size: 2rem;
            line-height: 1;
        }
    </style>
@stop

@section('script')
    <!-- Select2 -->
    <script>
        console.log('Hello Human',moment());
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
                startDate: moment(),
                endDate  : moment()
            },
            function (start, end) {
                $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
        );
        $('#daterange-btn').on('apply.daterangepicker', function(ev, picker) {
            $('#from').val(picker.startDate.format('YYYY-MM-DD'));
            $('#to').val(picker.endDate.format('YYYY-MM-DD'));
            $('#search').submit();
        });

    </script>
    <script type="text/javascript" src="js/article.js"></script>
    <script>
        function view_articel_now(url) {
            newwindow=window.open(url,'VietNamHoiNhap','height=500,width=800,top=150,left=200, location=0');
            if (window.focus) {newwindow.focus()}
            return false;
        }
    </script>

    {{-- xuất file excel --}}
    <script src="plugins/table_excel/jquery.table2excel.min.js"></script>
    <script type="text/javascript">
        function print(){
            $("#table_report").table2excel({
                exclude: ".noExl",
                name: "VietNamHoiNhap",
                filename: "vnhn",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true
            });
        }

        // function printData()
        // {
        //    var divToPrint=document.getElementById("content");
        //    newWin= window.open("");
        //    newWin.document.write(divToPrint.outerHTML);
        //    newWin.print();
        //    newWin.close();
        // }

        // $('btn_print').on('click',function(){
        //     printData();
        // })
    </script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // $('#table_report').DataTable( {
                
            // } );
            $('#table_report').DataTable( {
                // "pagingType": "full_numbers",
                "paging":   false,
                dom: 'Bfrtip',
                buttons: [
                    'print'
                ]
            } );

            
        } );
    </script>

@stop