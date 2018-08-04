@extends('admin.master')

@section('title', 'Thêm tài khoản')
@section('main')
	
<div class="content-wrapper">
	<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{isset($item)? 'Thay đổi' : 'Thêm mới'}} Emagazine</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ asset('admin') }}">Trang chủ</a></li>
              <li class="breadcrumb-item"><a href="{{ asset('admin/emagazine') }}">Emagazine</a></li>
              <li class="breadcrumb-item active">{{isset($item)? 'Thay đổi' : 'Thêm mới'}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-9 col-sm-12">
			      <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">{{isset($item)? 'Thay đổi' : 'Thêm mới'}}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
              <form role="form" method="post" enctype="multipart/form-data" action="{{isset($item)?  asset('admin/emagazine/edit/'.$item->e_id) : asset('admin/emagazine/add')}}">
                <div class="card-body">
                	<div class="form-group">
	                    <label for="exampleInputEmail1">Tiêu đề</label>
	                    <input type="text" class="form-control" placeholder="Tiêu đề" name="e_title" value="{{isset($item)? $item->e_title : ''}}" required>
	                </div>
	                <div class="form-group">
	                    <label for="exampleInputEmail1">Tóm tắt</label>
                      <textarea rows="5" placeholder="Nội dung tóm tắt" class="form-control" name="e_summary">{{isset($item)? $item->e_summary : ''}}</textarea>
	                </div>
	                <div class="form-group">
	                    <label for="exampleInputEmail1">Tiêu đề CEO</label>
	                    <input type="text" class="form-control" placeholder="Tiêu đề CEO" name="e_title_meta" value="{{isset($item)? $item->e_title_meta : ''}}"> 
	                </div>
	                <div class="form-group">
	                    <label for="exampleInputPassword1">Từ khóa CEO</label>
	                    <input type="text" class="form-control" placeholder="Từ khóa CEO" name="e_keyword_meta" value="{{isset($item)? $item->e_keyword_meta : ''}}">
	                </div>
	                <div class="form-group">
	                    <label for="exampleInputPassword1">Chi tiết</label>
	                    <input type="file" class="form-control" name="e_detail">
	                </div>
	                <div class="form-group">
	                    <label for="exampleInputFile">Ảnh đại diện</label>
                      <div>
                        <input id="img" type="file" name="e_img" class="cssInput" onchange="changeImg(this)" style="display: none!important;">
                        <img style="cursor: pointer;" id="avatar" class="cssInput thumbnail imageForm" src="{{ isset($item->e_img) && file_exists(storage_path('app/emagazine/'.$item->e_img)) && $item->e_img ? asset('local/storage/app/emagazine/resized-'.$item->e_img) : '../images/default-image.png' }}">
                      </div>
	                </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="submit" class="btn btn-primary" value="{{isset($item)? 'Thay đổi' : 'Thêm mới'}}">
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
