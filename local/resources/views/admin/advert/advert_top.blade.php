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
            <h1>Tổ chức quảng cáo</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ asset('admin') }}">Trang chủ</a></li>
              <li class="breadcrumb-item"><a href="{{ asset('admin/advert') }}">Quảng cáo</a></li>
              <li class="breadcrumb-item active">Tổ chức</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-6">
          

          <div class="card">
            <div class="card-header">
              <form method="get" action="">
                <div class="row">
                  <div class="col-6">
                    <select class="form-control">
                      @foreach ($group as $item)
                        <option value="{{$item->id}}" {{Request::segment(4) == $item->id ? 'selected' : '' }}>{{$item->title}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                    
              </form>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <table id="example" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Tiêu để</th>
                  <th>Hình ảnh</th>
                  <th>Tùy chọn</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($item_tops as $item)
                  <tr>
                    <td>
                      {{$item->advert->ad_name}}
                    </td>
                    <td>
                      <img src="{{ asset('local/storage/app/advert/resized-'.$item->advert->ad_img) }}"  style="max-width: 300px;">
                      
                    </td>
                    <td>
                     
                      <a href="{{ asset('admin/advert/top_delete/'.$item->adt_id) }}" onclick="return confirm('Bạn chắc chắn muốn xóa')" class="btn btn-danger btn-sm"> Xóa</a>
                      
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
        <div class="col-6">
          

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
                      <img src="{{ asset('local/storage/app/advert/resized-'.$item->ad_img) }}"  style="max-width: 300px;">
                      
                    </td>
                    <td>{{$item->ad_status}}</td>
                    <td>
                      <a href="{{ asset('admin/advert/top_add/'.Request::segment(4).'/'.$item->ad_id) }}" class="btn btn-primary btn-sm">Chọn</a>
                      
                      
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
    <!-- Main content -->
    
  </div>

@stop

@section('script')

<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.js"></script>
{{-- <script type="text/javascript" src="js/advert_top.js"></script>
 --}}
<script>
  $(function () {
    $("#example1").DataTable();

  });
  $(document).ready(function(){
    $('select').on('change', function() {
      window.location.href = 'http://localhost/vnhn/admin/advert/top/'+this.value;
    })
    // $('option').click(function(){
    //   alert('ok');
    //   var gr_id = $(this).attr('value');
    //   window.location.href = 'http://localhost/vnhn/admin/advert/top/'+gr_id;
    // });
  });
</script>

@stop