@extends('admin.master')

@section('title', 'Thêm tài khoản')
@section('main')
	
<div class="content-wrapper">
	<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sắp xếp bài viết</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ asset('admin') }}">Trang chủ</a></li>
              <li class="breadcrumb-item active">Sắp xếp bài viết</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

	@if (session('error'))
		<div class="alert alert-error">
			<p>{{ session('error') }}</p>
		</div>
	@endif

	@if (session('status'))
		<div class="alert alert-success">
			<p>{{ session('status') }}</p>
		</div>
	@endif

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
			<section class="col-md-12 connectedSortable">
				<!-- TO DO List -->
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
							<i class="ion ion-clipboard mr-1"></i>
							Bài viết trang chủ
						</h3>
					</div>

					<form action="{{route('sort_hot_articel_post')}}" method="post">
						{{csrf_field()}}
						<div class="row card-header">
							<div class="col-md-9">
								<select class="form-control select2" data-placeholder="Chọn danh mục cha"
										name="groupid"
										style="width: 100%;">
									@foreach($list_group as $group_item)
										<option {{$group_id == $group_item->id ? 'selected' : ''}} value="{{ $group_item->id }}">{{ $group_item->title }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-3">
								<button class="btn btn-primary float-right" type="submit"><i class="fa fa-search"></i>
								</button>
							</div>
						</div>
					</form>

					<!-- /.card-header -->
					<form method="post" action="{{route('update_order_articel')}}">
						{{csrf_field()}}
						<div class="card-body">
							<input class="d-none" value="{{$group_id}}" name="articel[groupid]">
							<ul class="todo-list">
								@foreach($list_articel as $articel)
									<li>
										<span class="handle">
										  <i class="fa fa-ellipsis-v"></i>
										  <i class="fa fa-ellipsis-v"></i>
										</span>
										<input style="width: 50px" type="text" value="{{$loop->index + 1}}"
											   name="articel[{{$articel->id}}]">
										<span class="text">{{$articel->title}}</span>
										<span>&nbsp;&nbsp;&nbsp;</span>
										<span>{{date('d/m/Y H:m',$articel->created_at)}}</span>
										<div class="tools">
											<a href="{{route('delete_articel_hot',['groupid' => $group_id,'id' => $articel->id])}}" class="text-danger">
												<i class="fa fa-trash-o"></i>
											</a>
										</div>
									</li>
								@endforeach
							</ul>
						</div>
						<!-- /.card-body -->
						<div class="card-footer clearfix">
							<button type="submit" class="btn btn-info float-right"><i class="fa fa-plus"></i> Cập nhật
							</button>
						</div>
					</form>
				</div>
			</section>

			<section class="col-md-5 connectedSortable" id="group-child">

			</section>
        </div>
      </div>
    </section>
</div>
@stop
@section('script')
	<!-- FastClick -->
	<script src="plugins/fastclick/fastclick.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="dist/js/demo.js"></script>

	<script>
        // Make the dashboard widgets sortable Using jquery UI
        $('.connectedSortable').sortable({
            placeholder         : 'sort-highlight',
            connectWith         : '.connectedSortable',
            handle              : '.card-header, .nav-tabs',
            forcePlaceholderSize: true,
            zIndex              : 999999
        });
        $('.connectedSortable .card-header, .connectedSortable .nav-tabs-custom').css('cursor', 'move')

        // jQuery UI sortable for the todo list
        $('.todo-list').sortable({
            placeholder         : 'sort-highlight',
            handle              : '.handle',
            forcePlaceholderSize: true,
            zIndex              : 999999,
			update : function () {
				$('.todo-list li').each(function (e) {
					$(this).children('input').val(e + 1);
                })
            }
        })
	</script>
@stop
