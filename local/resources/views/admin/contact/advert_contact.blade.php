@extends('admin.master')

@section('title', 'Liên hệ quảng cáo')
@section('main')
<!-- DataTables -->
{{-- <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap4.css"> --}}
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Liên hệ quảng cáo</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ asset('admin') }}">Trang chủ</a></li>
              <li class="breadcrumb-item active">Liên hệ quảng cáo</li>
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
              <h3 class="card-title">Liên hệ quảng cáo</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <table class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Tên</th>
                  <th>Số điện thoại</th>
                  <th class="hideResponsive768">Email</th>
                  <th class="hideResponsive768">Thành phố</th>
                  <th class="hideResponsive768">Công ty</th>
                  <th>Chi tiêt</th>
                </tr>
                </thead>
                <tbody>
                	@foreach ($items as $item)
                	<tr>
	                  <td>
                      
	                     {{ $item->name }}
	                  </td>
	                  <td>
	                  	{{$item->phone}}
	                  </td>
	                  <td class="hideResponsive768">{{$item->email}}</td>
	                  <td class="hideResponsive768">{{$item->city}}</td>
	                  <td class="hideResponsive768">{{$item->company}}</td>
	                  <td>
	                  	
	                  	<button class="btn btn-info btnDetail" >Xem</button>
                      <div class="contact_id" style="display: none">{{ $item->id }}</div>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="modal_item">
              <span class="modal_item_title">Tên: </span>
              <span class="modalName"></span>
            </div>
            <div class="modal_item">
              <span class="modal_item_title">Số điện thoại: </span>
              <span class="modalPhone"></span>
            </div>
            <div class="modal_item">
               <span class="modal_item_title">Email: </span>
              <span class="modalEmail"></span>
            </div>
            <div class="modal_item">
              <span class="modal_item_title">Thành phố:</span>
              <span class="modalAddress"></span>
            </div>
            <div class="modal_item">
              <span class="modal_item_title">Doanh nghiệp:</span>
              <span class="modalNo"></span>
            </div>
            <div class="modal_item">
              <span class="modal_item_title">Loại hình:</span>
              <span class="modalAmount"></span>
            </div>
            <div class="modal_item">
              <span class="modal_item_title">Nội dung:</span>
              <span class="modalContent"></span>
            </div>
              
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
          </div>
        </div>
      </div>
    </div>
  </div>

@stop

@section('script')

<!-- DataTables -->
<script type="text/javascript" src="js/advert_contact.js"></script>

@stop