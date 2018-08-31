<option value="" disabled selected>Chọn danh mục con</option>
@foreach($list_group_child as $group)
    <option value="{{ $group->id }}">{{ $group->title }}</option>
@endforeach