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
            <h1>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Quản lý tài khoản' : 'Account management'}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ asset('admin') }}">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Trang chủ' : 'Home'}}</a></li>
              <li class="breadcrumb-item active">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Tài khoản' : 'Account'}}</li>
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
              <h3 class="card-title">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Danh sách tài khoản' : 'Account list'}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th class="hideResponsive768">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Hình ảnh' : 'Image'}}</th>
                  <th>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Tên đăng nhập' : 'Username'}}</th>
                  <th class="hideResponsive768">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Họ tên' : 'Fullname'}}</th>
                  <th class="hideResponsive768">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Email' : 'Email'}}</th>
                  <th>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Chức vụ' : 'Position'}}</th>
                  <th>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Tùy chọn' : 'Option'}}</th>
                </tr>
                </thead>
                <tbody>
                	@foreach ($items as $item)
                	<tr>
	                  <td class="hideResponsive768">
                      <div class="avatarImg50" style="background: url('{{ file_exists(storage_path('app/avatar/'.$item->img)) && $item->img ? asset('local/storage/app/avatar/resized-'.$item->img) : '../images/images.png' }}') no-repeat center /cover;">
                        
                      </div>
	                  	

	                  </td>
	                  <td>
	                  	{{$item->username}}
	                  </td>
	                  <td class="hideResponsive768">{{$item->fullname}}</td>
	                  <td class="hideResponsive768">{{$item->email}}</td>
	                  <td>{{level_format($item->level)}}</td>
	                  <td>
	                  	@if(Auth::user()->level < $item->level || Auth::user()->level == 1)
                        <a href="{{ asset('admin/account/edit/'.$item->id) }}" class="btn btn-primary">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Sửa' : 'Edit'}}</a>
                        <a href="{{ asset('admin/account/delete/'.$item->id) }}" onclick="return confirm('Bạn chắc chắn muốn xóa')" class="btn btn-danger">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Xóa' : 'Delete'}}</a>
                      @endif
	                  	{{-- @if (Auth::user()->id == $item->id)
	                  		<a href="{{ asset('admin/account/delete/'.$item->id) }}" onclick="alert('Bạn không được xóa chính mình'); return false;" class="btn btn-danger"> Xóa</a>
	                  	@else 
	                  		
	                  	@endif --}}
	                  	
	                  </td>
	                </tr>
                	@endforeach
	                
	        <div>
            </div>

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

@stop

@section('script')

<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.js"></script>
<script type="text/javascript" src="js/account.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();

  });
</script>

@stop