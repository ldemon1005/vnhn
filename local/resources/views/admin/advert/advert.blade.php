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
            <h1>Quản lý quảng cáo</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ asset('admin') }}">Trang chủ</a></li>
              <li class="breadcrumb-item active">Quảng cáo</li>
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
              <h3 class="card-title">Danh sách quảng cáo</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Tiêu để</th>
                  <th>Hình ảnh</th>
                  <th>Lượt xem</th>
                  <th>Ngày cập nhật</th>
                  <th>Trạng thái</th>
                  <th>Tùy chọn</th>
                </tr>
                </thead>
                <tbody>
                	@foreach ($items as $item)
                	<tr>
	                  <td>
	                  	{{$item->ad_name}}
	                  </td>
	                  <td>
                      <img src="{{ isset($item->ad_img) && file_exists(storage_path('app/advert/resized-'.$item->ad_img)) && $item->ad_img ? asset('local/storage/app/advert/resized-'.$item->ad_img) : '../images/default-image.png' }}"  style="max-width: 300px;">
	                  	
	                  </td>
	                  <td>{{$item->ad_view}}</td>
	                  <td>{{date_format($item->created_at, 'd/m/Y')}}</td>
	                  <td>
                      @if ($item->ad_status == 1)
                        <button type="button" class="btn btn-block btn-outline-success btn-sm btnOff">Bật</button>
                      @else
                        <button type="button" class="btn btn-block btn-outline-danger btn-sm btnOn">Tắt</button>
                      @endif
                      <div class="id_hidden" style="display: none;">{{$item->ad_id}}</div> 
                    </td>
	                  <td>
	                  	<a href="{{ asset('admin/advert/edit/'.$item->ad_id) }}" class="btn btn-primary btn-sm">Sửa</a>
                      <a href="{{ asset('admin/advert/delete/'.$item->ad_id) }}" onclick="return confirm('Bạn chắc chắn muốn xóa')" class="btn btn-danger btn-sm"> Xóa</a>
	                  	
	                  </td>
	                </tr>
                	@endforeach

                </tbody>
                {{-- <tfoot>
                <tr>
                  <th>Rendering engine</th>
                  <th>Browser</th>
                  <th>Platform(s)</th>
                  <th>Engine version</th>
                  <th>CSS grade</th>
                </tr>
                </tfoot> --}}
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

@stop

@section('script')

<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.js"></script>
<script type="text/javascript" src="js/advert_top.js"></script>

<script>
  $(function () {
    $("#example1").DataTable();

  });
</script>

@stop