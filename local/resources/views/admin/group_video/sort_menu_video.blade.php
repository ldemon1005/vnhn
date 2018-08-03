@extends('admin.master')

@section('title', 'Thêm tài khoản')
@section('main')
	
<div class="content-wrapper">
	<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sắp xếp menu video</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ asset('admin') }}">Trang chủ</a></li>
              <li class="breadcrumb-item active">Danh sách video / Sắp xếp menu video</li>
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
			<section class="col-md-6 connectedSortable">
				<!-- TO DO List -->
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
							<i class="ion ion-clipboard mr-1"></i>
							Danh sách menu video
						</h3>
					</div>

					<!-- /.card-header -->
					<form method="post" action="{{route('sort_menu')}}">
						{{csrf_field()}}
						<div class="card-body">
							<ul class="todo-list">
								@foreach($list_menu as $menu)
									<li>
										<span class="handle">
										  <i class="fa fa-ellipsis-v"></i>
										  <i class="fa fa-ellipsis-v"></i>
										</span>
										<input style="width: 50px" type="text" value="{{$loop->index + 1}}"
											   name="menu_video[{{$menu->id}}]">
										<span class="text">{{$menu->title}}</span>
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
