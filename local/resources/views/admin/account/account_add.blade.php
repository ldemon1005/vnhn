@extends('admin.master')

@section('title', 'Thêm tài khoản')
@section('main')
	
<div class="content-wrapper">
	<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Thêm mới tài khoản</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ asset('admin') }}">Trang chủ</a></li>
              <li class="breadcrumb-item active">Tài khoản</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6 col-sm-9">
			<div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Thêm mới</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             
              <form role="form" method="post" enctype="multipart/form-data">
                <div class="card-body">
                	<div class="form-group">
	                    <label for="exampleInputEmail1">Tên đăng nhập</label>
	                    <input type="text" class="form-control" placeholder="Username" name="username">
	                </div>
	                <div class="form-group">
	                    <label for="exampleInputEmail1">Họ và tên</label>
	                    <input type="fullname" class="form-control" placeholder="Fullname" name="fullname">
	                </div>
	                <div class="form-group">
	                    <label for="exampleInputEmail1">Email</label>
	                    <input type="email" class="form-control" placeholder="Enter email" name="email"> 
	                </div>
	                <div class="form-group">
	                    <label for="exampleInputPassword1">Mật khẩu</label>
	                    <input type="password" class="form-control" placeholder="Password" name="password">
	                </div>
	                <div class="form-group">
	                    <label for="exampleInputPassword1">Số điện thoại</label>
	                    <input type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask name="phone">
	                </div>
	                <div class="form-group">
	                    <label for="exampleInputFile">Ảnh đại diện</label>
						<div class="">
							<input id="img" type="file" name="img" class="cssInput" onchange="changeImg(this)" style="display: none!important;">
		                    <img style="cursor: pointer;" id="avatar" class="cssInput thumbnail" height="300px" src="img/new_seo-10-512.png">
						</div>
	                </div>
	                <div class="form-group">
	                	<label for="exampleInputFile">Chức vụ</label>
	                	<select class="form-control select2" style="width: 100%;" name="level">

		                    <option value="3" selected="selected">Phóng viên</option>
		                    <option value="2">Biên tập viên</option>
		                    @if (Auth::user()->level == 1)
		                    	<option value="1">Admin</option>
		                    @endif
		                    
		                </select>
	                </div>
		                
                  	
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <input type="submit" class="btn btn-primary" value="Thêm mới">
                  {{csrf_field()}}
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
@stop
@section('script')
{{-- <script src="plugins/select2/select2.full.min.js"></script>
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script> --}}
@stop
