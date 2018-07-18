<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th style="width: 25%">Tiêu đề video</th>
                    <th style="width: 25%">Link video</th>
                    <th>Người sửa</th>
                    <th>Ngày tạo</th>
                    <th>Trạng thái</th>
                </tr>
                </thead>
                <tbody>
                @foreach($list_history as $history)
                    <tr>
                        <td>{{$history->title}}</td>
                        <td>{{$history->url_video}}</td>
                        <td>{{$history->user ? $history->user->username : $history->userId}}</td>
                        <td>
                            {{$history->created_at}}
                        </td>
                        <td>{{$history->GhiChu}}</td>
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