@extends('admin.master')

@section('title', 'Thêm tài khoản')
@section('main')
	
<div class="content-wrapper">
	<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? (isset($item)? 'Thay đổi tài khoản' : 'Thêm mới tài khoản') : (isset($item)? 'Edit account' : 'Add account')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ asset('admin') }}">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Trang chủ' : 'Home'}}</a></li>
              <li class="breadcrumb-item"><a href="{{ asset('admin/account') }}">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Tài khoản' : 'Account'}}</a></li>
              <li class="breadcrumb-item active">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? (isset($item)? 'Thay đổi' : 'Thêm mới') : (isset($item)? 'Edit' : 'Add')}}</li>
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
			      <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? (isset($item)? 'Thay đổi tài khoản' : 'Thêm mới tài khoản') : (isset($item)? 'Edit account' : 'Add account')}}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
              <form role="form" method="post" enctype="multipart/form-data" action="{{isset($item)?  asset('admin/account/edit/'.$item->id) : asset('admin/account/add')}}">
                <div class="card-body">
                	<div class="form-group">
	                    <label for="exampleInputEmail1">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Tên đăng nhập' : 'Username'}}</label>
	                    <input type="text" class="form-control" placeholder="Username" name="username" value="{{isset($item)? $item->username : ''}}" required>
	                </div>
	                <div class="form-group">
	                    <label for="exampleInputEmail1">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Họ và tên' : 'Fullname'}}</label>
	                    <input type="fullname" class="form-control" placeholder="Fullname" name="fullname" value="{{isset($item)? $item->fullname : ''}}">
	                </div>
	                <div class="form-group">
	                    <label for="exampleInputEmail1">Email</label>
	                    <input type="email" class="form-control" placeholder="Enter email" name="email" value="{{isset($item)? $item->email : ''}}"> 
	                </div>
	                <div class="form-group">
	                    <label for="exampleInputPassword1">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Mật khẩu' : 'Password'}}</label>
	                    <input type="password" class="form-control" placeholder="Password" name="password">
	                </div>
	                <div class="form-group">
	                    <label for="exampleInputPassword1">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Số điện thoại' : 'Phone'}}</label>
	                    <input type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask name="phone" value="{{isset($item)? $item->phone : ''}}" >
	                </div>
	                <div class="form-group">
	                    <label for="exampleInputFile">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Ảnh đại diện' : 'Avatar'}}</label>
                      <div>
                        <input id="img" type="file" name="img" class="cssInput" onchange="changeImg(this)" style="display: none!important;">
                        <img style="cursor: pointer;" id="avatar" class="cssInput thumbnail imageForm" src="{{ isset($item->img) && file_exists(storage_path('app/avatar/'.$item->img)) && $item->img ? asset('local/storage/app/avatar/resized-'.$item->img) : '../images/images.png' }}">
                      </div>
      		            
	                </div>
	                <div class="form-group">
	                	<label for="exampleInputFile">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Chức vụ' : 'Position'}}</label>
	                	<select class="form-control select2" style="width: 100%;" name="level">
                        @if (Auth::user()->level < 4)
                          <option value="4" @if (isset($item) && $item->level == 4) selected="selected" @endif >{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Phóng viên' : 'Reporter'}}</option>
                        @endif
                        @if (Auth::user()->level < 3)
                          <option value="3" @if (isset($item) && $item->level == 3) selected="selected" @endif >{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Biên tập viên' : 'Editor'}}</option>
                        @endif
		                    @if (Auth::user()->level <= 2)
                          <option value="2" @if (isset($item) && $item->level == 2) selected="selected" @endif >{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Phó tổng biên tập' : 'Deputy editor'}}</option>
                        @endif
		                    @if (Auth::user()->level == 1)
                          <option value="1" @if (isset($item) && $item->level == 1) selected="selected" @endif >Super Admin</option>
                        @endif
		                    
		                </select>
	                </div>
                  {{-- {{ isset($group_id)? '1' : '0' }} --}}
                  <div class="form-group">
                      <label for="exampleInputPassword1">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Quyền truy cập' : 'Access'}}</label>
                      <select class="form-control select2" multiple="multiple" data-placeholder="Chọn danh mục" name="group_id[]" style="width: 100%;" required>
                          @foreach($list_group as $group)

                            <option {{isset($gr_acc) && in_array($group->id,$gr_acc) && $gr_acc[0] != null? 'selected' : ''}} value="{{ $group->id }}">{{ $group->title }}</option>
                          @endforeach
                    </select>
                  </div>
                  @if (Auth::user()->level == 1)
                    <div class="form-group">
                        <label for="exampleInputFile">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Công ty' : 'Company'}}</label>
                        <div>
                          <select class="form-control" data-placeholder="Chọn công ty" name="site" style="width: 100%;">
                            <option {{isset($item) && $item->site == 1 ? 'selected' : ''}} value="1">Cgroup</option>
                            <option {{isset($item) && $item->site == 2 ? 'selected' : ''}} value="2">Việt Nam Hội Nhập</option>
                          </select>
                        </div>
                    </div>
                  @endif
                    
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="submit" class="btn btn-primary" value="{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? (isset($item)? 'Thay đổi' : 'Thêm mới') : (isset($item)? 'Edit' : 'Add')}}">
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
