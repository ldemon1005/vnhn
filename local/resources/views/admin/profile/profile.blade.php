@extends('admin.master')

@section('title', 'Hồ sơ')
@section('main')
	
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Hồ sơ cá nhân</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ asset('admin') }}">Trang chủ</a></li>
            <li class="breadcrumb-item active">Hồ sơ</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">

          <!-- Profile Image -->
          <div class="card card-danger card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                     src="{{ asset('local/storage/app/avatar/'.$item->img) }}"
                     alt="User profile picture">
              </div>

              <h3 class="profile-username text-center">{{$item->fullname}}</h3>

              <p class="text-muted text-center">{{level_format($item->level)}}</p>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Tên đăng nhập</b> <a class="float-right">{{$item->username}}</a>
                </li>
                <li class="list-group-item">
                  <b>Email</b> <a class="float-right">{{$item->email}}</a>
                </li>
                <li class="list-group-item">
                  <b>Điện thoại</b> <a class="float-right">{{$item->phone}}</a>
                </li>
                <li class="list-group-item">
                  <b>Ngày tạo</b> <a class="float-right">{{date_format($item->created_at,"h:m d-m-Y")}}</a>
                </li>
              </ul>

              <a href="{{ asset('admin/profile/change_pass') }}" class="btn btn-danger btn-block"><b>Thay đổi mật khẩu</b></a>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <div class="col-md-8">
          <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title">Chỉnh sửa hồ sơ</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data">
              <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Tên đăng nhập</label>
                    <input type="text" class="form-control" placeholder="Username" name="username" value="{{$item->username}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Họ và tên</label>
                    <input type="fullname" class="form-control" placeholder="Fullname" name="fullname" value="{{$item->fullname}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" placeholder="Enter email" name="email" value="{{$item->email}}"> 
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Số điện thoại</label>
                    <input type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask name="phone" value="{{$item->phone}}" >
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Ảnh đại diện</label>
                    
                    <div>
                      <input id="img" type="file" name="img" class="cssInput" onchange="changeImg(this)" style="display: none!important;">
                      <img style="cursor: pointer;" id="avatar" class="cssInput thumbnail" height="300px" src="{{ asset('local/storage/app/avatar/'.$item->img) }}">
                    </div>
                    
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <input type="submit" class="btn btn-primary" value="Thay đổi">
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
