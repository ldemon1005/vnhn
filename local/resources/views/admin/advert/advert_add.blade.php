@extends('admin.master')

@section('title', 'Thêm tài khoản')
@section('main')
	
<div class="content-wrapper">
	<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{isset($item) ? 'Sửa lại' : 'Thêm mới' }} quảng cáo</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ asset('admin') }}">Trang chủ</a></li>
              <li class="breadcrumb-item"><a href="{{ asset('admin/advert') }}">Quảng cáo</a></li>
              <li class="breadcrumb-item active">{{isset($item) ? 'Sửa lại' : 'Thêm mới' }}</li>
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
                <h3 class="card-title">{{isset($item) ? 'Sửa lại' : 'Thêm mới' }}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" enctype="multipart/form-data" action="{{isset($item)? asset('admin/advert/edit/'.$item->ad_id) : asset('admin/advert/add')}}">
                <div class="card-body">
                	<div class="form-group">
	                    <label for="exampleInputEmail1">Tên quảng cáo</label>
	                    <input type="text" class="form-control" placeholder="tên quảng cáo" name="name" value="{{isset($item) ? $item->ad_name : ''}}">
	                </div>
	                <div class="form-group">
	                    <label for="exampleInputEmail1">Liên kết đến</label>
	                    <input type="text" class="form-control" placeholder="https://" name="link" value="{{isset($item) ? $item->ad_link : ''}}">
	                </div>
	                {{-- <div class="form-group">
	                    <label for="exampleInputEmail1">Thời gian hiển thị</label>
	                    <input type="text" class="form-control" placeholder="1000" name="time" value="{{isset($item) ? $item->ad_time : ''}}"> 
	                </div> --}}
	                <div class="form-group">
	                    <label for="exampleInputPassword1">Nội dung tóm tắt</label>
	                    <textarea class="form-control" name="content" rows="5">{{isset($item) ? $item->ad_content : ''}}</textarea>
	                </div>
	                {{-- <div class="form-group">
	                    <label for="exampleInputPassword1">Chiều rộng</label>
	                    <input type="text" class="form-control" name="width" placeholder="100% or 320px" value="{{isset($item) ? $item->ad_width : ''}}">
	                </div>
	                <div class="form-group">
	                    <label for="exampleInputPassword1">Chiều cao</label>
	                    <input type="text" class="form-control" name="height" placeholder="100% or 200px" value="{{isset($item) ? $item->ad_height : ''}}">
	                </div> --}}
	                <div class="form-group">
	                    <label for="exampleInputFile">Hình ảnh</label>
						      <div class="">
  							    <input id="img" type="file" name="img" class="cssInput" onchange="changeImg(this)" style="display: none!important;">
                    <img style="cursor: pointer;max-width: 100%;max-height: 300px;" id="avatar" class="cssInput thumbnail imageForm" src="{{ isset($item->ad_img) && file_exists(storage_path('app/advert/resized-'.$item->ad_img)) && $item->ad_img ? asset('local/storage/app/advert/resized-'.$item->ad_img) : '../images/default-image.png' }}">
  						    </div>
	                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <input type="submit" class="btn btn-primary" value="{{isset($item) ? 'Sửa lại' : 'Thêm mới' }}">
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
