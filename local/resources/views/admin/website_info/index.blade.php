@extends('admin.master')

@section('title', 'Tài khoản')
@section('main')
<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap4.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lý thông tin website</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
              <li class="breadcrumb-item active">Thông tin website</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Thông tin website</h3>
            </div>
            <!-- /.card-header -->

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
              <a data-toggle="modal" data-target="#add_info" class="btn btn-primary"><h3 class="card-title">Thêm mới</h3></a>
            </div>

            <div class="card-body">

              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Thuộc tính</th>
                  <th>Giá trị</th>
                  <th>Icon</th>
                  <th>Ngày cập nhật</th>
                  <th>Thao tác</th>

                </tr>
                </thead>
                <tbody>
                	@foreach ($website_info as $web_info)
                	<tr>
	                  <td>{{$web_info->key}}</td>
	                  <td>{{$web_info->value}}</td>
	                  <td>{{$web_info->updated_at}}</td>
                      <td>
                        <div class="row form-group">
                          <a style="cursor: pointer" onclick="updateWebsiteInfo({{$web_info->id}})" title="Chỉnh sửa" class="col-sm-6 text-center text-primary"><i class="fa fa-wrench"></i></a>
                          <a data-toggle="tooltip" title="Xóa" onclick="return confirm('Bạn có chắc chắn xóa? Một số dữ liệu sẽ không thể khôi phục!')" href="{{route('delete_info',$web_info->id)}}" class="col-sm-6 text-center text-danger"><i
                                    class="fa fa-trash"></i></a>
                        </div>
                      </td>
	                </tr>
                	@endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

<!-- Modal -->
<div class="modal fade" id="add_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thêm mới thông tin website</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="add_info" method="post" action="{{ url('/admin/website_info/add_info') }}">
        {{csrf_field()}}
        <div class="modal-body">
          <div class="row form-group d-none">
            <label class="col-md-3">Id</label>
            <div class="col-md-9">
              <input name="info[id]" class="form-control">
            </div>
          </div>

          <div class="row form-group">
            <label class="col-md-3">Key</label>
            <div class="col-md-9">
              <input name="info[key]" class="form-control">
            </div>
          </div>

          <div class="row form-group">
            <label class="col-md-3">Giá trị</label>
            <div class="col-md-9">
              <input name="info[value]" class="form-control">
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
</div>

@stop

@section('script')

<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.js"></script>
<script type="text/javascript" src="js/account.js"></script>
<script>
    function form_submit() {
        $('#add_info').submit();
    }


    $(function () {
        $("#example1").DataTable();
    });
</script>

@stop