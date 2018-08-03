<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{$group_video->id == 0 ? 'Thêm mới danh mục video' : 'Sửa
             danh mục video'}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{route('action_menu_video')}}" method="post">
            {{csrf_field()}}
            <div class="modal-body">
                <input class="form-control d-none" name="menu_video[id]" value="{{$group_video->id}}">
                <div class="row form-group">
                    <label class="col-md-4">Tên danh mục</label>
                    <div class="col-md-8">
                        <input class="form-control" name="menu_video[title]" value="{{$group_video->title}}">
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-4">Icon video</label>
                    <div class="col-md-8">
                        <input class="form-control" name="menu_video[icon]" placeholder="sử dụng fontawesome"
                               value="{{$group_video->icon}}">
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-4">Trạng thái</label>
                    <div class="col-md-8">
                        <div class="row">
                            <label class="col-md-5 text-primary">
                                <input value="1" type="radio" name="group[status]" {{ $group_video->status != 0
                                             ? 'checked' : '' }}>
                                Hoạt động
                            </label>
                            <label class="col-md-5 text-primary">
                                <input value="0" type="radio" name="group[status]" {{ $group_video->status == 0
                                             ? 'checked' : '' }}>
                                Không hoạt động
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Gửi</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
            </div>
        </form>
    </div>
</div>