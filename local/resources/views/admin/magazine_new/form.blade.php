@extends('admin.master')

@section('title', 'Thêm tài khoản')
@section('main')
	
<div class="content-wrapper">
	<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{isset($item)? 'Thay đổi' : 'Thêm mới'}} tạp chí</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ asset('admin') }}">Trang chủ</a></li>
              <li class="breadcrumb-item"><a href="{{ asset('admin/magazine') }}">Tạp chí</a></li>
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
              
              <form role="form" method="post" enctype="multipart/form-data" action="{{isset($item)?  asset('admin/magazine/edit/'.$item->m_id) : asset('admin/magazine/add')}}">
                <div class="card-body">
                	<div class="form-group">
	                    <label for="exampleInputEmail1">Tiêu đề</label>
	                    <input type="text" class="form-control" placeholder="Tiêu đề" name="m_title" value="{{isset($item)? $item->m_title : ''}}" required>
	                </div>
	                
	                <div class="form-group">
	                    <label for="exampleInputFile">Hình ảnh</label>
                      <div>
                        <input id="img" type="file" name="m_img" class="cssInput" onchange="changeImg(this)" style="display: none!important;">
                        <img style="cursor: pointer;" id="avatar" class="cssInput thumbnail imageForm" src="{{ isset($item->m_img) && file_exists(storage_path('app/magazine/'.$item->m_img)) && $item->m_img ? asset('local/storage/app/magazine/resized-'.$item->m_img) : '../images/default-image.png' }}">
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
