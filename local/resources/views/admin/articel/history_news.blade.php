<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Lịch sử sửa đổi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th style="width: 25%">Tiêu đề bài viết</th>
                    <th>Người sửa</th>
                    <th>Ngày sửa</th>
                    <th>Ghi chú</th>
                    <th>Xem</th>
                </tr>
                </thead>
                <tbody>
                @foreach($list_history as $history)
                    <tr>
                        <td>{{$history->title}}</td>
                        <td>{{$history->user ? $history->user->username : $history->userId}}</td>
                        <td>
                            {{$history->created_at}}
                        </td>
                        <td>{{$history->GhiChu}}</td>
                        <td><a style="cursor: pointer" onclick="view_articel('{{route('view_log',$history->ID)}}')" title="Xem chi tiết"><i class="fa fa-eye"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="row form-group pull-right" style="margin: 10px 0px">
                {!! $list_history->links('vendor.pagination.bootstrap-4') !!}
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
        </div>
    </div>
</div>


<div class="modal fade" id="history_articel_view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lịch sử sửa đổi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>

<script>
    function view_articel(url) {
        newwindow=window.open(url,'VietNamHoiNhap','height=500,width=800,top=150,left=200, location=0');
        if (window.focus) {newwindow.focus()}
        return false;
    }
</script>