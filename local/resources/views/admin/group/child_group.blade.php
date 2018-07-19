<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="ion ion-clipboard mr-1"></i>
            {{$group_parent->title}}
        </h3>
    </div>
    <!-- /.card-header -->
    <form method="post" action="{{route('update_order')}}">
        {{csrf_field()}}
        <input class="d-none" value="{{$group_parent->id}}" name="group[parentid]">

        <div class="card-body">
            <ul class="todo-list">
                @foreach($list_group as $group)
                    <li>
								<span class="handle">
								  <i class="fa fa-ellipsis-v"></i>
								  <i class="fa fa-ellipsis-v"></i>
								</span>
                        <input style="width: 50px" type="text" value="{{$loop->index + 1}}"
                               name="group[{{$group->id}}]">
                        <a><span class="text">{{$group->title}}</span></a>
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
<script>
    $('.connectedSortable .card-header, .connectedSortable .nav-tabs-custom').css('cursor', 'move')

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

