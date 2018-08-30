@foreach($list_group_child as $group)
    <option value="{{ $group->id }}">{{ $group->title }}</option>
@endforeach