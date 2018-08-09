@foreach($list_ward as $ward)
    {{-- <option value="{{$ward->maqh}}">{{$ward->name}}</option> --}}
    <option value="{{$ward->name}}" id="{{$ward->maqh}}">{{$ward->name}}</option>
@endforeach