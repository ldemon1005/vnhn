<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cập nhật thông tin website</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="add_info" method="post" action="{{ url('/admin/website_info/update_info') }}">
            {{csrf_field()}}
            <div class="modal-body">
                <div class="row form-group d-none">
                    <label class="col-md-3">Id</label>
                    <div class="col-md-9">
                        <input name="info[id]" value="{{$website_info->id}}" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3">Key</label>
                    <div class="col-md-9">
                        <input name="info[key]" value="{{$website_info->key}}" class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3">Giá trị</label>
                    <div class="col-md-9">
                        <input name="info[value]" value="{{$website_info->value}}" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                <button onclick="form_submit()" type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>

    </div>
</div>